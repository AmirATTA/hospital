<?php

namespace App\Http\Controllers\admin;

use App\Models\Surgery;
use App\Models\Insurance;
use App\Models\Operation;
use App\Models\DoctorRole;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SurgeryStoreRequest;
use App\Http\Requests\SurgeryUpdateRequest;
use App\Traits\RedirectNotify;
use Illuminate\Database\Eloquent\Builder;

class SurgeryController extends Controller
{
    use RedirectNotify;

    /**
     * MiddleWares.
     */
    public function __construct()
    {
        $this->middleware('permission:view surgeries')->only('index');

        $this->middleware('permission:create surgeries')->only('create');
    }

    /**
     * Handle the search functionality.
     */
    public function search(Request $request)
    {
        $search = $request->all();

        $surgeries = Surgery::query()
            ->when($search['document_number'], fn (Builder $query) => $query->where('document_number', $search['document_number']))
            ->when($search['patient_name'], fn (Builder $query) => $query->where('patient_name', 'like', '%'.$search['patient_name'].'%'))
            ->when($search['fromSurgeriedDate'], fn (Builder $query) => $query->where('created_at', '>=', $search['fromSurgeriedDate']))
            ->when($search['toSurgeriedDate'], fn (Builder $query) => $query->where('created_at', '<=', $search['toSurgeriedDate']))
            ->when($search['fromReleasedDate'], fn (Builder $query) => $query->where('created_at', '>=', $search['fromReleasedDate']))
            ->when($search['toReleasedDate'], fn (Builder $query) => $query->where('created_at', '<=', $search['toReleasedDate']))
            ->paginate(15)
            ->withQueryString();

        return view('admin.surgery.index')->with([
            'surgeries' => $surgeries,
            'search' => $search,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surgeries = Surgery::orderBy('id', 'desc')->paginate(15);
        
        return view('admin.surgery.index')->with([
            'surgeries' => $surgeries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctorRoles = DoctorRole::orderBy('title', 'desc')->with('doctors')->get();
        $insurances = Insurance::orderBy('type', 'desc')->get();
        $operations = Operation::where('status', '1')->get();

        return view('admin.surgery.create')->with([
            'insurances' => $insurances,
            'operations' => $operations,
            'doctorRoles' => $doctorRoles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SurgeryStoreRequest $request)
    {
        $operations = $request->input('operations');
        $doctorsInputRequired = $request->input('doctorsInputRequired') != null ? $request->input('doctorsInputRequired') : [];
        $doctorsInputNotRequired = $request->input('doctorsInput') != null ? $request->input('doctorsInput') : [];
        $doctorsInput = array_merge($doctorsInputRequired, $doctorsInputNotRequired);

        $doctorIds = [];
        $doctorRoleIds = [];
        foreach ($doctorsInput as $value) {
            if($value != null) {
                [$firstNumber, $secondNumber] = explode(", ", $value);
                $doctorIds[] = $firstNumber;
                $doctorRoleIds[] = $secondNumber;
            }
        }

        $repeatedDoctors = array_unique($doctorIds);

        if (count($doctorIds) !== count($repeatedDoctors)) {
            return redirect()->back()->with('error', 'شما نمیتوانید یک دکتر را برای چند نقش مختلف انتخاب کنید');
        }

        if($request->insurance != null) {
            $insurance = Insurance::where('id', $request->insurance)->first();

            if($insurance->type == 'basic') {
                $validated = array_merge($request->validated(), [
                    'basic_insurance_id' => $insurance->id, 
                ]);
            } else if($insurance->type == 'supplementary') {
                $validated = array_merge($request->validated(), [
                    'supp_insurance_id' => $insurance->id, 
                ]);
            }

            Arr::forget($validated, 'insurance');
        } else {
            $validated = array_merge($request->validated());
        }


        $surgery = surgery::create($validated);
        $surgery->attachOperations($operations);
        $surgery->attachDoctors($doctorsInput);

        if(!$surgery) {
            return $this->redirectNotify('surgeries.create', 'error', 'عملیات به مشکل مواجه شد!');
        } else {
            return $this->redirectNotify('surgeries.index', 'success', 'عملیات با موفقیت انجام شد.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $surgery = Surgery::findOrFail($id);

        $ultimatePrice = 0;
        $operations = $surgery->operations()->select('name', 'price')->get()->toArray();
        foreach ($operations as $operation) {
            $ultimatePrice += $operation['price'];
        }

        $insuranceId = $surgery->basic_insurance_id != null ? $surgery->basic_insurance_id : $surgery->supp_insurance_id;
        if($insuranceId != null) {
            $insurance = Insurance::findOrFail($insuranceId);
            $discountedPrice = $ultimatePrice - ($ultimatePrice * ($insurance->discount / 100));
            $discountedPriceFromOriginal = $ultimatePrice * ($insurance->discount / 100);
            $insuranceType = $insurance->type == 'supplementary' ? 'تکمیلی' : 'پایه';
        } else {
            $insurance = null;
            $discountedPrice = null;
            $insuranceType = null   ;
        }

        $doctors = $surgery->doctors;

        return view('admin.surgery.show')->with([
            'surgery' => $surgery,

            'operations' => $operations,
            'ultimatePrice' => $ultimatePrice,
            
            'insurance' => $insurance,
            'discountedPriceFromOriginal' => round($discountedPriceFromOriginal),
            'discountedPrice' => round($discountedPrice),
            'insuranceType' => $insuranceType,

            'doctors' => $doctors,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $surgery = Surgery::findOrFail($id);

        $doctorRoles = DoctorRole::orderBy('title', 'desc')->with('doctors')->get();
        $insurances = Insurance::orderBy('type', 'desc')->get();
        $operations = Operation::where('status', '1')->get();

        $insurance = $surgery->basic_insurance_id != null ? $surgery->basic_insurance_id : $surgery->supp_insurance_id;

        $operationIds = $surgery->operations()->pluck('operations.id')->toArray();

        $doctors = $surgery->doctors()->pluck('doctors.id')->toArray();

        return view('admin.surgery.edit')->with([
            'surgery' => $surgery,

            'insurance' => $insurance,
            'operations' => $operations,
            'doctorRoles' => $doctorRoles,

            'insurances' => $insurances,

            'operationIds' => $operationIds,

            'doctors' => $doctors,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SurgeryUpdateRequest $request, string $id)
    {
        $surgery = Surgery::findOrFail($id);

        $operations = $request->input('operations');
        $doctorsInputRequired = $request->input('doctorsInputRequired');
        $doctorsInputNotRequired = $request->input('doctorsInput');
        $doctorsInput = array_merge($doctorsInputRequired, $doctorsInputNotRequired);

        if($request->insurance != null) {
            $insurance = Insurance::where('id', $request->insurance)->first();

            if($insurance->type == 'basic') {
                $validated = array_merge($request->validated(), [
                    'basic_insurance_id' => $insurance->id, 
                ]);
            } else if($insurance->type == 'supplementary') {
                $validated = array_merge($request->validated(), [
                    'supp_insurance_id' => $insurance->id, 
                ]);
            }

            Arr::forget($validated, 'insurance');
        } else {
            $validated = array_merge($request->validated());
        }


        $surgery->update($validated);
        $surgery->attachOperations($operations, true);
        $surgery->attachDoctors($doctorsInput, true);
        
        return $this->redirectNotify('surgeries.index', 'success', 'بروزرسانی با موفیقت انجام شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $surgery = Surgery::findOrFail($id);
        $surgery->delete();
    }
}
