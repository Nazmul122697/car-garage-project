<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FeeStructure;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class FeeStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('fee-structures.index');

        $feeStructures = FeeStructure::orderBy('id','asc')->get();
        return view('backend.fee_structure.index',compact('feeStructures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('fee-structures.create');

        return view('backend.fee_structure.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('fee-structures.create');

        $request->validate([
            'min' => 'nullable|numeric',
            'max' => 'nullable|numeric',
            'fee' => 'required|numeric',
        ]);
        try {
            FeeStructure::create([
                'min' => $request->min,
                'max' => $request->max,
                'fee' => $request->fee,
            ]);

            notify()->success('Fee created successfully','success');
            return redirect()->route('fee-structures.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Fee create failed','error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('fee-structures.edit');

        $feeStructure = FeeStructure::findOrFail($id);
        return view('backend.fee_structure.edit',compact('feeStructure'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('fee-structures.edit');

        $request->validate([
            'min' => 'nullable|numeric',
            'max' => 'nullable|numeric',
            'fee' => 'required|numeric',
        ]);
        try {
            $feeStructure = FeeStructure::findOrFail($id);
            $feeStructure->Update([
                'min' => $request->min,
                'max' => $request->max,
                'fee' => $request->fee,
            ]);

            notify()->success('Fee updated successfully','success');
            return redirect()->route('fee-structures.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Fee update failed','error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
