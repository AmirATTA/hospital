<?php

namespace App\Http\Controllers\admin;

use App\Models\Insurance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\InsuranceStoreRequest;
use App\Http\Requests\InsuranceUpdateRequest;
use App\Traits\RedirectNotify;
use Illuminate\Database\Eloquent\Builder;

class InsuranceController extends Controller
{
    use RedirectNotify;
    
    /**
     * MiddleWares.
     */
    public function __construct()
    {
        $this->middleware('permission:view insurances')->only('index');

        $this->middleware('permission:create insurances')->only('create');
    }

    /**
     * Handle the search functionality.
     */
    public function search(Request $request)
    {
        $search = $request->all();

        $insurances = Insurance::query()
        ->when($search['name'], fn (Builder $query) => $query->where('name', 'like', '%'.$search['name'].'%'))
        ->when($search['type'], fn (Builder $query) => $query->where('type', $search['type']))
            ->paginate(15)
            ->withQueryString();

        return view('admin.insurance.index')->with([
            'insurances' => $insurances,
            'search' => $search,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $insurances = Insurance::orderBy('id', 'desc')->paginate(15);
        return view('admin.insurance.index')->with([
            'insurances' => $insurances,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.insurance.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InsuranceStoreRequest $request)
    {
        $insurance = Insurance::create($request->validated());

        if(!$insurance) {
            return $this->redirectNotify('insurances.create', 'error', 'عملیات به مشکل مواجه شد!');
        } else {
            return $this->redirectNotify('insurances.index', 'success', 'عملیات با موفقیت انجام شد.');
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
    public function edit(Insurance $insurance)
    {
        return view('admin.insurance.edit')->with([
            'insurance' => $insurance,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InsuranceUpdateRequest $request, string $id)
    {
        $insurance = Insurance::findOrFail($id);

        $insurance->update($request->validated());

        return $this->redirectNotify('insurances.index', 'success', 'بروزرسانی با موفقیت انجام شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $insurance = Insurance::findOrFail($id);
        $insurance->delete();
    }
}
