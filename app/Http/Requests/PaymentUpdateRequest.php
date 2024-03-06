<?php

namespace App\Http\Requests;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class PaymentUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'invoice_id' => 'required',
            'payment_id' => 'required',
            'amount' => [
                'required',
                'gte:25000',
                function ($attribute, $value, $fail) {
                    $amount = intval(request('amount'));

                    $payment = Payment::select('amount')->find(request('payment_id'));
                    
                    $invoice = Invoice::select('id', 'amount')->find(request('invoice_id'));
                    $invoiceAmount = $invoice->amount - intval($invoice->paymentSum()) + $payment->amount;

                    if ($amount > $invoiceAmount) {
                        $fail('قیمت نمیتواند از حداکثر مبلغ قابل پرداخت بیشتر باشد');
                    }
                },
            ],
            'pay_type' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (request('pay_type') == 'cheque' && empty(request('due_date'))) {
                        $fail('تکملی گزینه زمان سررسید الزامی است');
                    }
                },
            ],
            'due_date' => 'nullable',
            'receipt' => 'nullable',
            'description' => 'nullable',
        ];
    }
}
