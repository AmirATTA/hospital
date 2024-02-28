<?php

namespace App\Http\Controllers\admin;

use App\Models\Speciality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SpecialityRequest;
use App\Http\Requests\SpecialityStoreRequest;
use App\Http\Requests\SpecialityUpdateRequest;
use App\Traits\RedirectNotify;
use Illuminate\Database\Eloquent\Builder;

class SpecialityController extends Controller
{
    use RedirectNotify;

    /**
     * MiddleWares.
     */
    public function __construct()
    {
        $this->middleware('permission:view specialities')->only('index');

        $this->middleware('permission:create specialities')->only('create');
    }

    /**
     * Handle the search functionality.
     */
    public function search(Request $request)
    {
        $search = $request->all();

        $specialities = Speciality::query()
        ->when($search['title'], fn (Builder $query) => $query->where('title', 'like', '%'.$search['title'].'%'))
            ->paginate(15)
            ->withQueryString();

        return view('admin.speciality.index')->with([
            'specialities' => $specialities,
            'search' => $search,
        ]);
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
    public function store(SpecialityStoreRequest $request)
    {
        $speciality = Speciality::create($request->validated());

        if(!$speciality) {
            return $this->redirectNotify('specialities.create', 'error', 'عملیات به مشکل مواجه شد!');
        } else {
            return $this->redirectNotify('specialities.index', 'success', 'عملیات با موفقیت انجام شد.');
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
    public function update(SpecialityUpdateRequest $request, string $id)
    {
        $speciality = Speciality::findOrFail($id);

        $speciality->update($request->validated());

        return $this->redirectNotify('specialities.index', 'success', 'بروزرسانی با موفیقت انجام شد.');
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
