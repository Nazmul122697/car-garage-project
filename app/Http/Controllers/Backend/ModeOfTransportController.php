<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\ModeOfTransport;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ModeOfTransportController extends Controller
{

    public function index()
    {
        Gate::authorize('transport-modes.index');

        $modes = ModeOfTransport::orderBy('id','desc')->get();
        return view('backend.transport_mode.index',compact('modes'));
    }

    public function create()
    {
        Gate::authorize('transport-modes.create');

        return view('backend.transport_mode.create');
    }


    public function store(Request $request)
    {
        Gate::authorize('transport-modes.create');

        $request->validate([
            'name' => 'required',
        ]);

        try {
            ModeOfTransport::create([
                'name' => $request->name,
                'status' => $request->filled('status') ? 1 : 0,
            ]);

            notify()->success("Mode of transport created successfully.", "Success");
            return redirect()->route('transport-modes.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Mode of transport create Failed', 'Error');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        Gate::authorize('transport-modes.edit');

        $mode = ModeOfTransport::findOrFail($id);
        return view('backend.transport_mode.edit',compact('mode'));
    }

    public function update(Request $request,$id)
    {
        Gate::authorize('transport-modes.edit');

        $request->validate([
            'name' => 'required',
        ]);

        try {

            $mode = ModeOfTransport::findOrFail($id);
            $mode->update([
                'name' => $request->name,
                'status' => $request->filled('status') ? 1 : 0,
            ]);

            notify()->success("Mode of transport updated successfully.", "Success");
            return redirect()->route('transport-modes.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Mode of Transport Update Failed', 'Error');
            return redirect()->back();
        }

    }

    public function destroy($id)
    {
        Gate::authorize('transport-modes.destroy');

        try {
            $mode = ModeOfTransport::findorFail($id);
            $mode->delete();

            notify()->success("Mode of transport deleted successfully.", "Success");
            return redirect()->route('transport-modes.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Mode of Transport Deleted Failed', 'Error');
            return redirect()->back();

        }
    }


}
