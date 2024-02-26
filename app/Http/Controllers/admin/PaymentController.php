<?php

namespace App\Http\Controllers\admin;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\RedirectNotify;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        $invoice = Invoice::findOrFail($request->invoice_id);
        if($invoice->paymentSum() + $request->amount >= $invoice->amount) {
            $invoice->update([
                'status' => 1,
            ]);
        }

        $payment = Payment::create($validated);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
