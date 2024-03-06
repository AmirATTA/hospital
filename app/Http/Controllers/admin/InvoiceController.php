<?php

namespace App\Http\Controllers\admin;

use App\Models\Doctor;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Surgery;
use App\Models\Operation;
use App\Models\DoctorRole;
use Illuminate\Http\Request;
use App\Models\DoctorSurgery;
use App\Traits\RedirectNotify;
use App\Models\OperationSurgery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class InvoiceController extends Controller
{
    use RedirectNotify;
    
    /**
     * MiddleWares.
     */
    public function __construct()
    {
        $this->middleware('permission:view invoices')->only('index');

        $this->middleware('permission:create invoices')->only('create');
    }

    /**
     * Handle the search functionality.
     */
    public function search(Request $request)
    {
        $search = $request->all();

        $status = $request['status'] == 'true' ? 1 : 0;
        
        $invoices = Invoice::query()
            ->when($search['status'], fn (Builder $query) => $query->where('status', $status))
            ->when($search['id'], fn (Builder $query) => $query->where('id', $search['id']))
            ->paginate(15)
            ->withQueryString();

        $invoicesSearch = Invoice::select('id', 'doctor_id')->get();

        return view('admin.invoice.index')->with([
            'invoices' => $invoices,
            'search' => $search,
            'invoicesSearch' => $invoicesSearch,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::orderBy('id', 'desc')->paginate(15);

        $invoicesSearch = Invoice::select('id', 'doctor_id')->get();

        return view('admin.invoice.index')->with([
            'invoices' => $invoices,
            'invoicesSearch' => $invoicesSearch,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = Invoice::findOrFail($id);

        $doctor = Doctor::select('id', 'name')->findOrFail($invoice->doctor_id);

        $doctorSurgery = DoctorSurgery::where('invoice_id', $invoice->id)->pluck('surgery_id');

        $surgeries = [];
        $surgeriesTotalPrice = 0;
        $doctorRoleQuotaAmount = 0;
        foreach ($doctorSurgery as $key) {
            $surgeries[] = Surgery::where('id', $key)->get()[0];
            $doctorRole = DoctorRole::where('id', DoctorSurgery::where('doctor_id', $doctor->id)->where('surgery_id', end($surgeries)->id)->first()->doctor_role_id)->get()[0];
            $surgeriesTotalPrice += end($surgeries)->getTotalPrice();
            $doctorRoleQuotaAmount += end($surgeries)->getDoctorQuotaAmount($doctorRole);
        }

        $payments = Payment::query()
            ->where('invoice_id', $invoice->id)
            ->select('id', 'amount', 'created_at', 'pay_type', 'due_date')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.invoice.show')->with([
            'invoice' => $invoice,
            'doctor' => $doctor,
            'payments' => $payments,
            'surgeries' => $surgeries,
            'surgeriesTotalPrice' => $surgeriesTotalPrice,
            'doctorRoleQuotaAmount' => $doctorRoleQuotaAmount,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        return view('admin.invoice.edit')->with([
            'invoice' => $invoice,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $invoice = Invoice::findOrFail($id);
        
        $invoice->update([
            'description' => $request->description,
        ]);

        return $this->redirectNotify('invoices.index', 'success', 'بروزرسانی با موفقیت انجام شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Payment::where('invoice_id', $id)->get()->toArray();
        if(!$payment) {
            $invoice = Invoice::findOrFail($id);
            $invoice->delete();
        }
    }

    /**
     * Retrive description data.
     */
    public function description(string $id)
    {
        $invoice = Invoice::select('description')->findOrFail($id);
        return response()->json($invoice->description);
    }
}
