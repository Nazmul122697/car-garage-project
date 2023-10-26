<?php

namespace App\Http\Controllers\Backend;

use App\Models\UserManual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class UserManualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('user-manuals.index');
        $user_manuals = UserManual::orderBy('id', 'DESC')->get();
        return view('backend.user_manual.index', compact('user_manuals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('user-manuals.create');
        return view('backend.user_manual.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('user-manuals.create');
        // dd($request->all());
        $request->validate([
            'title' => 'required|unique:user_manuals,title',
            'file' => 'required|mimes:pdf',
        ]);
        // dd($request->all());
        try {
            if ($request->has('file')) {
                $file = $request->file('file');
                $file_name = 'PDF_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/user-manual/'), $file_name);
            }
            UserManual::create([
                'title' => $request->title,
                'file' => $file_name,
                'status' => $request->filled('status'),
            ]);
            notify()->success('User Manual Created Successfully', 'Success');
            return redirect()->route('user-manuals.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('User Manual Create Failed', 'Error');
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
        Gate::authorize('user-manuals.show');
        $user_manual = UserManual::findOrFail($id);
        return view('backend.user_manual.show', compact('user_manual'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('user-manuals.edit');
        $user_manual = UserManual::findOrFail($id);
        return view('backend.user_manual.edit', compact('user_manual'));
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
        Gate::authorize('user-manuals.edit');
        $user_manual = UserManual::findOrFail($id);
        $request->validate([
            'title' => 'required|unique:user_manuals,title,' . $user_manual->id,
            'file' => 'mimes:pdf',
        ]);
        try {
            $updateData = [
                'title' => $request->title,
                'status' => $request->filled('status'),
            ];
            if ($request->has('file')) {
                $file = $request->file('file');
                $file_name = 'PDF_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/user-manual/'), $file_name);
                $updateData['file'] = $file_name;
                @unlink('upload/user-manual/' . $user_manual->file);
            }
            $user_manual->update($updateData);
            notify()->success("User Manual Updated successfully.", "Success");
            return redirect()->route('user-manuals.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error("User Manual Updated Failed.", "Error");
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
        Gate::authorize('user-manuals.destroy');
        try {
            $user_manual = UserManual::findOrFail($id);
            if ($user_manual->file) {
                $unlink_file = 'upload/user-manual/' . $user_manual->file;
            }
            $user_manual->delete();
            @unlink($unlink_file);
            notify()->success("User Manual Deleted successfully.", "Success");
            return redirect()->route('user-manuals.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error("User Manual Delete Failed.", "Error");
            return back();
        }
    }
}
