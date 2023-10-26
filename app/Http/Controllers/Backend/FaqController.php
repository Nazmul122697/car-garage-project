<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Gate::authorize('faq.index');
        $faqs = Faq::orderBy('id', 'asc')->get();
        return view('backend.faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Gate::authorize('faq.create');
        return view('backend.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Gate::authorize('faq.create');

        $request->validate([
            'title' => 'required|unique:faqs,title',
            'description' => 'required'
        ]);
        try {
            Faq::create([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->filled('status'),
            ]);
            notify()->success('Faq Created Successfully', 'Success');
            return redirect()->route('faq.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Faq Create Failed', 'Error');
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
        // Gate::authorize('faq.edit');
        $faq = Faq::findOrFail($id);
        return view('backend.faq.edit', compact('faq'));
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
        // Gate::authorize('faq.edit');
        $request->validate([
            'title' => 'required|unique:faqs,title,' .$id,
            'description' => 'required'
        ]);

        try {
            $faq = Faq::findOrFail($id);
            $faq->update([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->filled('status'),
            ]);
            notify()->success('FAQ Updated Successfully', 'Success');
            return redirect()->route('faq.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('FAQ Updated Failed', 'Error');
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
        // Gate::authorize('faq.destroy');
        try {
            Faq::findOrFail($id)->delete();
            notify()->success('FAQ Deleted Successfully', 'Success');
            return redirect()->route('faq.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('FAQ Deleted Failed', 'Error');
            return back();
        }
    }
}
