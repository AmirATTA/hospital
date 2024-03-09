<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Invoice;
use App\Models\Surgery;
use App\Models\DoctorRole;
use Illuminate\Http\Request;
use App\Models\DoctorSurgery;
use App\Traits\RedirectNotify;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;

class DoctorSurgeryController extends Controller
{
    use RedirectNotify;
    
    /**
     * MiddleWares.
     */
    public function __construct()
    {
        $this->middleware('permission:view doctor-surgeries')->only('index');

        $this->middleware('permission:create doctor-surgeries')->only('create');

        $this->middleware('permission:edit doctor-surgeries')->only('edit');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::whereHas('doctor_surgeries', function ($query) {
            $query->whereNull('invoice_id');
        })->get();

        return view('admin.doctor-surgery.index')->with([
            'doctors' => $doctors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $search = collect($request->all())->except('_token')->all();

        $doctorId = $search['doctor'];
        
        $doctorName = Doctor::select('name')->where('id', $doctorId)->first();

        $startDate = $search['start_date'] == null ? Carbon::now()->toDateString() : $search['start_date'];
        
        $surgeries = DoctorSurgery::where('doctor_id', $doctorId)->pluck('surgery_id');
        // $surgeries = Surgery::whereHas('doctors', function ($query) use ($doctorId) {
        //     $query->where('doctor_id', $doctorId);
        // })->whereBetween('created_at', [$startDate, $search['end_date']])->get();

        return view('admin.doctor-surgery.create')->with([
            'surgeries' => $surgeries,
            'doctorId' => $doctorId,
            'doctorName' => $doctorName,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->except('_token');

        if(empty($requestData)) {
            return $this->redirectNotify('doctor-surgeries.index', 'error', 'هيچ داده اي وارد نشده.');
        }

        $invoices = $requestData['invoices'];

        $doctorInvoice = [];
        $doctorSurgeryIds = [];

        foreach($invoices as $invoice) {
            $invoice = explode(', ', $invoice);

            $doctorId = intval($invoice[0]);

            $doctorInvoice[] = $invoice[1];

            $doctorSurgeryIds[] = $invoice[2];
        }

        // Convert array values to integers for calculations
        $intDoctorInvoice = array_map('intval', $doctorInvoice);

        // Calculate the total sum of array elements
        $DoctorInvoiceSum = array_sum($intDoctorInvoice);

        $validated = [
            'amount' => $DoctorInvoiceSum, 
            'description' => null,
            'status' => 0,
            'doctor_id' => $doctorId,
        ];
        $invoice = Invoice::create($validated);

        foreach ($doctorSurgeryIds as $id) {
            DoctorSurgery::where('id', $id)->update(['invoice_id' => $invoice->id]);
        }

        return $this->redirectNotify('invoices.index', 'success', 'عملیات با موفقیت انجام شد.');
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
