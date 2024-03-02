<?php

namespace App\Http\Controllers\admin;

use App\Models\Insurance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\RedirectNotify;

class InsuranceReportController extends Controller
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
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.insurance-report.index');
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

    /**
     * Retrive insurance data's throught form ajax.
     */
    public function getInsuranceNames(Request $request)
    {
        $insurances = Insurance::select('id', 'name')->where('type', $request->data)->orderBy('id', 'desc')->get();

        return response()->json($insurances);
    }
}
