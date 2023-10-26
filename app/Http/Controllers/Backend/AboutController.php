<?php

namespace App\Http\Controllers\Backend;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AboutController extends Controller
{

    public function index()
    {
        Gate::authorize('abouts.index');

        $about = About::first();
        return view('backend.about.index', compact('about'));
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('abouts.index');

        $about = About::findOrFail($id);
        $request->validate([
            'history' => 'required',
            'history_bn' => 'required',
            'mission' => 'required',
            'mission_bn' => 'required',
            'vision' => 'required',
            'vision_bn' => 'required',
            'strategy' => 'required',
            'strategy_bn' => 'required',
            'goals' => 'required',
            'goals_bn' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff',
        ]);

        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/about/' . $about->image));
                $filename = 'IMG_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/about/'), $filename);
                $about->update([
                    "image" => $filename,
                ]);
            }
            $about->update([
                'history' => $request->history,
                'history_bn' => $request->history_bn,
                'mission' => $request->mission,
                'mission_bn' => $request->mission_bn,
                'vision' => $request->vision,
                'vision_bn' => $request->vision_bn,
                'strategy' => $request->strategy,
                'strategy_bn' => $request->strategy_bn,
                'goals' => $request->goals,
                'goals_bn' => $request->goals_bn
            ]);
            notify()->success('About Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('About Update Failed', 'Error');
            return back();
        }
    }


}
