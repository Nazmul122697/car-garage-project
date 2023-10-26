<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HelpDesk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class HelpLineController extends Controller
{
    public function helpDesk()
    {
        return view('frontend.help_line.index');
    }

    public function helpDeskSubmit(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:11',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);
        // dd($request->all());
        try {
            HelpDesk::create([
                'name'    => $request->name,
                'phone'   => $request->phone,
                'email'   => $request->email,
                'subject' => $request->subject,
                'message' => $request->message
            ]);

            // notify()->success('Request Created Successfully!', 'Success');
            return back()->with('success','Request Created Successfully!');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            // notify()->error('Request Create Failed', 'Error');
            return back()->with('error','Request Create Failed');
        }
    }
}
