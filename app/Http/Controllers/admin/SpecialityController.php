<?php

namespace App\Http\Controllers\admin;

use App\Models\Speciality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SpecialityRequest;

class SpecialityController extends Controller
{
    /**
     * MiddleWares.
     */
    public function __construct()
    {
        $this->middleware('permission:view specialities')->only('index');

        $this->middleware('permission:create specialities')->only('create');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $speciality = Speciality::orderBy('id', 'desc')->paginate(15);
        return view('admin.speciality.index')->with([
            'specialities' => $speciality,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.speciality.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SpecialityRequest $request)
    {
        $speciality = Speciality::create($request->validated());

        if(!$speciality) {
            return redirect(route('specialities.create'))->with('error', 'عملیان انجام نشد');
        } else {
            return redirect(route('specialities.index'))->with('success', 'دسته بندی ساخته شد!');
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
    public function edit(Speciality $speciality)
    {
        return view('admin.speciality.edit')->with([
            'specialities' => $speciality,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SpecialityRequest $request, string $id)
    {
        $speciality = Speciality::findOrFail($id);

        $speciality->update($request->validated());

        return redirect()->route('specialities.index')->with('success', 'خبر با موفقیت بروزرسانی شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $speciality = Speciality::findOrFail($id);
        $speciality->delete();
    }
}
