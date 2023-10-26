<?php

namespace App\Http\Controllers\Backend;

use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class WebsiteController extends Controller
{

    public function index()
    {
        // Gate::authorize('websites.index');
        $website = Website::first();
        return view('backend.website.index', compact('website'));
    }


    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'copyright' => 'required',
            'facebook' => 'required',
            'youtube' => 'required',
            'linkedin' => 'required',
            'logo' => 'mimes:jpeg,jpg,png',
            'favicon' => 'mimes:jpeg,jpg,png,ico',
            'email' => 'required',
            'reporting_email' => 'required',
            'feedback_email' => 'required',
            'phone1' => 'required',
            'phone2' => 'required',
            'lab' => 'required',
            'parameter' => 'required',
            'food_type' => 'required',
        ]);

        try {
            // dd($request->all());
            $website = Website::findOrFail($id);

            $website->fill([
                'copy_right' => $request->copyright,
                'facebook' => $request->facebook,
                'youtube' => $request->youtube,
                'linkedin' => $request->linkedin,
                'logo' => $this->updateImage($website, $request, 'logo'),
                'favicon' => $this->updateImage($website, $request, 'favicon'),
                'email' => $request->email,
                'reporting_email' => $request->reporting_email,
                'feedback_email' => $request->feedback_email,
                'phone1' => $request->phone1,
                'phone2' => $request->phone2,
                'lab' => $request->lab,
                'parameter' => $request->parameter,
                'food_type' => $request->food_type,
            ]);

            $website->save();

            notify()->success('Website Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th->getMessage());

            notify()->success('Website Updated Failed', 'Error');
            return redirect()->back();
        }
    }

    private function updateImage($website, $request, string $key)
    {

        if ($request->hasFile($key)) {
            $image = $request->file($key);
            $destinationPath = 'upload/website/';
            $imgName = $key . '-img-' . date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imgName);
            unset($image);
            return $imgName;
        }
        return $website->$key;
    }
}
