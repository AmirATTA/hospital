<?php

namespace App\Http\Controllers\admin;

use App\Models\Doctor;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\DoctorRole;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DoctorSurgery;
use App\Traits\RedirectNotify;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\PaymentStoreRequest;

class PaymentController extends Controller
{
    use RedirectNotify;
    
    /**
     * MiddleWares.
     */
    public function __construct()
    {
        $this->middleware('permission:view payments')->only('index');

        $this->middleware('permission:create payments')->only('create');
    }

    /**
     * Handle the search functionality.
     */
    public function search(Request $request)
    {
        $search = $request->all();

        $status = $request['status'] == 'true' ? 1 : 0;

        $payments = Payment::query()
            ->when($search['status'], fn (Builder $query) => $query->where('status', $status))
            ->when($search['pay_type'], fn (Builder $query) => $query->where('pay_type', $search['pay_type']))
            ->when($search['invoice_id'], fn (Builder $query) => $query->where('invoice_id', $search['invoice_id']))
            ->paginate(15)
            ->withQueryString();

        $invoices = Invoice::select('id', 'doctor_id')->get();

        return view('admin.payment.index')->with([
            'payments' => $payments,
            'search' => $search,
            'invoices' => $invoices,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::orderBy('id', 'desc')->paginate(15);

        $invoices = Invoice::select('id', 'doctor_id')->get();

        return view('admin.payment.index')->with([
            'payments' => $payments,
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
    public function store(PaymentStoreRequest $request)
    {
        if($request->file('receipt')) {
            $receiptPath = $request->file('receipt')->store('public/payment');
            $receiptName = basename($receiptPath);
        } else {
            $receiptName = null;
        }

        $validated = array_merge($request->validated(), [
            'invoice_id' => $request->invoice_id,
            'receipt' => $receiptName,
        ]);

        $payment = Payment::create($validated);

        $invoice = Invoice::findOrFail($request->invoice_id);
        if($invoice->paymentSum() >= $invoice->amount) {
            $invoice->update([
                'status' => 1,
            ]);

            $payments = Payment::where('invoice_id', $request->invoice_id)->get();

            foreach($payments as $payment) {
                $payment->update([
                    'status' => 1,
                ]); 
            }
        }

        if(!$payment) {
            return $this->redirectNotify('payments.create', 'error', 'عملیات به مشکل مواجه شد!');
        } else {
            return $this->redirectNotify('payments.index', 'success', 'عملیات با موفقیت انجام شد.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = Payment::findOrFail($id);

        $invoice = Invoice::findOrFail($payment->invoice_id);

        $doctor = Doctor::select('id', 'name')->findOrFail($invoice->doctor_id);

        $doctorSurgery = DoctorSurgery::select('doctor_role_id')->where('invoice_id', $invoice->$id)->first();

        $doctorRole = DoctorRole::select('title')->findOrFail($doctorSurgery->doctor_role_id);

        return view('admin.payment.show')->with([
            'payment' => $payment,
            'invoice' => $invoice,
            'doctor' => $doctor,
            'doctorRole' => $doctorRole,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        return view('admin.payment.edit')->with([
            'payment' => $payment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $payment = Payment::findOrFail($id);
        
        $payment->update([
            'description' => $request->description,
        ]);

        return $this->redirectNotify('payments.index', 'success', 'بروزرسانی با موفقیت انجام شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    /**
     * Retrive description data.
     */
    public function description(string $id)
    {
        $payment = Payment::select('description')->findOrFail($id);
        return response()->json($payment->description);
    }
}
