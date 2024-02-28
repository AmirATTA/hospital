<?php

namespace App\Http\Controllers\admin;

use App\Models\Doctor;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Surgery;
use App\Models\Operation;
use Illuminate\Http\Request;
use App\Models\DoctorSurgery;
use App\Traits\RedirectNotify;
use App\Models\OperationSurgery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    use RedirectNotify;
    
    /**
     * MiddleWares.
     */
    public function __construct()
    {
        $this->middleware('permission:view invoice')->only('index');

        $this->middleware('permission:create invoice')->only('create');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::orderBy('id', 'desc')->paginate(15);
        return view('admin.invoice.index')->with([
            'invoices' => $invoices,
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
        $operationSurgery = OperationSurgery::where('surgery_id', $doctorSurgery)->pluck('operation_id');

        $surgery = Surgery::where('id', $doctorSurgery)->get();

        $operations = [];
        foreach ($operationSurgery as $key) {
            $operations[] = Operation::where('id', $key)->get();
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
            'operations' => $operations,
            'surgery' => $surgery,
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
