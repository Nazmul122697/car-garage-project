<?php

namespace App\Http\Controllers\Backend;

use App\Models\TypeGood;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class TypeGoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('type-goods.index');

        $type_goods = TypeGood::orderBy('id', 'desc')->get();
        return view('backend.type_good.index', compact('type_goods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('type-goods.create');

        return view('backend.type_good.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('type-goods.create');

        $request->validate([
            'name' => 'required|unique:type_goods,name'
        ]);

        try {
            TypeGood::create([
                'name' => $request->name,
                'status' => $request->filled('status'),
            ]);

            notify()->success('Type Good Created Successfully', 'Success');
            return redirect()->route('type-goods.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Type Good Create Failed', 'Error');
            return back();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('type-goods.edit');

        $typeGood = TypeGood::findOrFail($id);
        return view('backend.type_good.edit', compact('typeGood'));
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
        Gate::authorize('type-goods.edit');

        $request->validate([
            'name' => 'required|unique:type_goods,name,' .$id
        ]);

        try {
            $typeGood = TypeGood::findOrFail($id);
            $typeGood->update([
                'name' => $request->name,
                'status' => $request->filled('status'),
            ]);

            notify()->success('Type Good Updated Successfully', 'Success');
            return redirect()->route('type-goods.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Type Good Updated Failed', 'Error');
            return back();
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
        Gate::authorize('type-goods.destroy');

        try {
            TypeGood::findOrFail($id)->delete();

            notify()->success('Type Good Deleted Successfully', 'Success');
            return redirect()->route('type-goods.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Type Good Deleted Failed', 'Error');
            return back();
        }
    }
}
