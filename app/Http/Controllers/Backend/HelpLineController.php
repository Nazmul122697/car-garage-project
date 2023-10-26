<?php

namespace App\Http\Controllers\Backend;

use App\Models\HelpDesk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class HelpLineController extends Controller
{
    public function helpLine()
    {
        Gate::authorize('help.line');

        $help_desks = HelpDesk::where('status', 0)->orderBy('id', 'desc')->get();
        return view('backend.help_line.index', compact('help_desks'));
    }

    public function helpLineCompleteSubmit(Request $request)
    {
        // dd($request->all());
        Gate::authorize('help.line');
        try {
            $help_desk = HelpDesk::findOrFail($request->id);
            $help_desk->update([
                'remarks' => $request->remark,
                'status'  => 1
            ]);

            $data = array(
                'name' => $help_desk->name,
                'messages' => $help_desk->message,
                'remarks' => $help_desk->remarks,
                'email' => $help_desk->email
            );
            // dd($data);
            Mail::send('backend.mail.help_desk', $data, function ($message) use ($data) {
                $message->from(env('MAIL_FROM_ADDRESS'), 'Bangladesh Food Safety Authority');
                $message->to($data['email']);
                $message->subject('Bangladesh Food Safety Authority Help Desk!');
            });

            notify()->success('Remark Save Successfully', 'Success');
            return redirect()->route('help.line');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Remark Save Failed', 'Error');
            return back();
        }
    }

    public function helpLineComplete()
    {
        Gate::authorize('help.line.complete');

        $help_desks = HelpDesk::where('status', 1)->orderBy('id', 'desc')->get();

        return view('backend.help_line.help_line_complete', compact('help_desks'));
    }
}
