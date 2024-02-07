<?php

namespace App\Http\Controllers\admin;

use App\Models\Operation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OperationStoreRequest;
use App\Http\Requests\OperationUpdateRequest;

class OperationController extends Controller
{
    /**
     * MiddleWares.
     */
    public function __construct()
    {
        $this->middleware('permission:view operations')->only('index');

        $this->middleware('permission:create operations')->only('create');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $operations = Operation::orderBy('id', 'desc')->paginate(15);
        return view('admin.operation.index')->with([
            'operations' => $operations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.operation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OperationStoreRequest $request)
    {
        $validated = array_merge($request->validated(), [
            'price' => str_replace(',', '', $request->input('price')), 
        ]);

        $operation = Operation::create($validated);

        if(!$operation) {
            return redirect(route('operations.create'))->with('error', 'عملیان انجام نشد');
        } else {
            return redirect(route('operations.index'))->with('success', 'عملیات با موفقیت انجام شد.');
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
    public function edit(Operation $operation)
    {
        return view('admin.operation.edit')->with([
            'operation' => $operation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OperationUpdateRequest $request, string $id)
    {
        $operation = Operation::findOrFail($id);

        $validated = array_merge($request->validated(), [
            'price' => str_replace(',', '', $request->input('price')), 
        ]);
        
        $operation->update($validated);

        return redirect()->route('operations.index')->with('success', 'خبر با موفقیت بروزرسانی شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $operation = Operation::findOrFail($id);
        $operation->delete();
    }
}
