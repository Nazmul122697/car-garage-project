<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tutorial;
use App\Models\UserManual;
use Illuminate\Http\Request;

class UserManualController extends Controller
{
    public function index()
    {
        $userManuals = UserManual::orderBy('id','desc')->where('status',1)->get()->take(3);
        // dd($userManuals);
        return view('frontend.user_manual.index',compact('userManuals'));
    }

    public function allUserManual()
    {
        $userManuals = UserManual::select('id','title')
                                   ->orderBy('id','desc')
                                   ->where('status',1)
                                   ->get();
        return view('frontend.user_manual.all',compact('userManuals'));
    }

    public function download(Request $request)
    {
        // dd($request->all());

        $pdf = UserManual::where('id', $request->id)->first();
        // dd($pdf);
        $pdfContent = $pdf->file;

        if (!$pdfContent) {
            return abort(404);
        } else {
            return response()->download(public_path('upload/user-manual/' . $pdf->file));
        }
    }

    public function loadMoreTutorial(Request $request)
    {
        $data = Tutorial::orderBy('id','desc')
                        ->where('status',1)
                        ->offset($request->offset)
                        ->limit($request->limit)->get();
        return response()->json($data);
    }
}
