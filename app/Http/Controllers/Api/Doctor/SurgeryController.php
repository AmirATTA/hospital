<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Models\Invoice;
use App\Models\Surgery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SurgeryController extends Controller
{
    public $doctor;

    public function __construct()
    {
        $this->doctor = auth()->guard('doctor-api')->user();
    }

    public function index() {
        
        $doctor = $this->doctor;
        
        $surgeries = Surgery::query()
            ->whereHas('doctors', fn ($query) => $query->where('doctor_id', $doctor->id))
            ->with([
                'doctors' => fn ($query) => $query->where('doctor_id', $doctor->id)
                ,'operations:id,name'
                ])
            ->select('id','patient_name','patient_national_code','surgeried_at','released_at')
            ->paginate();
            
        return response()->success('',compact('surgeries'));
    }
    
    public function show($id) {
        $doctor = $this->doctor;
        
        $surgery = Surgery::query()
            ->whereHas('doctors', fn ($query) => $query->where('doctor_id', $doctor->id))
            ->with([
                'doctors',
                'operations:id,name'
            ])
            ->findOrFail($id);

        $invoices = Invoice::query()
            ->select('amount', 'description', 'status')
            ->where('doctor_id', $doctor->id)
            ->get();

        $surgeryInvoice = array_merge($surgery->toArray(), $invoices->toArray());

        $surgeryInvoiceCollection = collect([$surgery, $invoices]);

        return response()->success('',compact('surgeryInvoiceCollection'));
    }
}
