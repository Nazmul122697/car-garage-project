<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('sliders.index');

        $sliders = Slider::orderBy('id','desc')->get();
        return view('backend.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('sliders.create');

        return view('backend.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('sliders.create');

        $request->validate([
            'title' => 'required | string | max:255',
            'image' => 'required | mimes:jpg,jpeg,png,bmp,tiff'
        ]);

        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = 'Slider_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/slider'), $filename);
            }

            Slider::create([
                'title' => $request->title,
                'image' => $filename,
                'status' => $request->filled('status'),
                'created_at' => Carbon::now()
            ]);

            notify()->success('Slider created successfully','success');
            return redirect()->route('sliders.index');

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Slider create failed','error');
            return redirect()->route('sliders.index');
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
        Gate::authorize('sliders.edit');

        $slider = Slider::findOrFail($id);
        return view('backend.slider.edit',compact('slider'));
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
        Gate::authorize('sliders.edit');

        $request->validate([
            'title' => 'required | string | max:255',
            'image' => 'nullable | mimes:jpg,jpeg,png,bmp,tiff'
        ]);

        try {
            $slider = Slider::findOrFail($id);

           if ($request->hasFile('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/slider/' . $slider->image));
                $filename = 'Slider_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/slider'), $filename);
                $slider->update([
                    "image" => $filename,
                ]);
            }

            $slider->update([
                'title' => $request->title,
                'status' => $request->filled('status')
            ]);

            notify()->success('Slider updated successfully','success');
            return redirect()->route('sliders.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Slider update failed','error');
            return redirect()->route('sliders.index');
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
        Gate::authorize('sliders.destroy');

        try {
            $slider = Slider::findOrFail($id);
            if ($slider->image) {
                @unlink(public_path('upload/slider/' . $slider->image));
            }
            $slider->delete();

            notify()->success('Slider deleted successfully','success');
            return redirect()->route('sliders.index');

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Slider delete error','error');
            return redirect()->back();
        }
    }
}
