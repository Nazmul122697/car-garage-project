<?php

namespace App\Http\Controllers\Backend;

use App\Models\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class TutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('tutorials.index');

        $tutorials = Tutorial::orderby('id', 'DESC')->get();
        return view('backend.tutorial.index', compact('tutorials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('tutorials.create');
        return view('backend.tutorial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('tutorials.create');

        $request->validate([
            'title' => 'required|unique:tutorials,title',
            'url' => 'required'
        ]);
        try {
            Tutorial::create([
                'title' => $request->title,
                'url' => $request->url,
                'status' => $request->filled('status'),
            ]);
            notify()->success('Tutorial Created Successfully', 'Success');
            return redirect()->route('tutorials.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Tutorial Create Failed', 'Error');
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
        Gate::authorize('tutorials.show');
        $tutorial = Tutorial::findOrFail($id);
        return view('backend.tutorial.show', compact('tutorial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('tutorials.edit');
        $tutorial = Tutorial::findOrFail($id);
        return view('backend.tutorial.edit', compact('tutorial'));
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
        Gate::authorize('tutorials.edit');

        $request->validate([
            'title' => 'required|unique:tutorials,title,' .$id,
            'url' => 'required'
        ]);

        try {
            $tutorial = Tutorial::findOrFail($id);
            $tutorial->update([
                'title' => $request->title,
                'url' => $request->url,
                'status' => $request->filled('status'),
            ]);
            notify()->success('Tutorial Updated Successfully', 'Success');
            return redirect()->route('tutorials.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Tutorial Updated Failed', 'Error');
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
        Gate::authorize('tutorials.destroy');
        try {
            Tutorial::findOrFail($id)->delete();
            notify()->success('Tutorial Deleted Successfully', 'Success');
            return redirect()->route('tutorials.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Tutorial Deleted Failed', 'Error');
            return back();
        }
    }
}
