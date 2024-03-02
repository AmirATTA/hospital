<?php

namespace App\Http\Requests;

use App\Models\Invoice;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class PaymentStoreRequest extends FormRequest
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
            'amount' => [
                'required',
                'gte:25000',
                function ($attribute, $value, $fail) {

                    $invoice = Invoice::select('amount')->find(request('invoice_id'));
                    
                    $amount = intval(request('amount'));

                    if (request('amount') > $invoice->amount) {
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