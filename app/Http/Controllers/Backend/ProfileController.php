<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\District;
use App\Models\Division;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        // Gate::authorize('profile.index');
        $divisions = Division::orderBy('name','asc')->get();
        $districts = District::orderBy('name','asc')->get();
        $countries = Country::orderBy('name','asc')->get();
        return view('backend.profile.index',compact('divisions','districts','countries'));
    }

    public function edit()
    {
        // Gate::authorize('profile.edit');
        $user = Auth::user();
        return view('backend.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        // Gate::authorize('profile.edit');
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        try {
            $user = User::findOrFail(Auth::id());
            // dd($user);

            //profile image
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/profile/' . $user->avatar));
                $filename = 'IMG_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/profile/'), $filename);
                $user->update([
                    "avatar" => $filename,
                ]);
            }

            //signature
            if ($request->hasFile('signature')) {
                $file = $request->file('signature');
                @unlink(public_path('upload/signature/' . $user->avatar));
                $filename = 'IMG_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/signature/'), $filename);
                $user->update([
                    "signature" => $filename,
                ]);
            }

            //seal
            if ($request->hasFile('seal')) {
                $file = $request->file('seal');
                @unlink(public_path('upload/seal/' . $user->avatar));
                $filename = 'IMG_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/seal/'), $filename);
                $user->update([
                    "seal" => $filename,
                ]);
            }

            $user->update([
                'name' => $request->name,
                'designation' => $request->designation != 'N/A' ? $request->designation : null,
                'email' => $request->email,
                'phone'  => $request->phone != 'N/A' ? $request->phone : null ,
                'division'  => $request->division,
                'district'  => $request->district
            ]);

            notify()->success('User Updated Successfully', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('User Update Failed', 'error');
            return back();
        }
    }

    public function changePassword()
    {
        // Gate::authorize('change.password');
        return view('backend.profile.change_password');
    }

    public function passwordUpdate(Request $request)
    {
        // Gate::authorize('change.password');
        $this->validate($request, [
            'current_password' => 'required',
            'password'         => 'required|confirmed|min:6',
        ]);

        $user = User::findOrFail(Auth::id());
        $hassedPassword = $user->password;

        if (Hash::check($request->current_password, $hassedPassword)) {
            if (!Hash::check($request->password, $hassedPassword)) {
                $user->update([
                    'password' => Hash::make($request->password),
                    'password_change_at' => Carbon::now(),
                ]);
                Auth::logout();
                return redirect()->route('login');
            } else {
                notify()->warning('New password can not be as old password!', 'Warning');
            }
        } else {
            notify()->error('Current password not match!', 'Error');
        }
        return back();
    }


    public function profileImageUpdate(Request $request)
    {
        // dd($request->all());

        switch ($request->action) {
            case 'upload':
                try {
                    $user = User::findOrFail($request->user_id);

                    if ($request->hasFile('image')) {
                        $file = $request->file('image');
                        @unlink(public_path('upload/profile/' . $user->avatar));
                        $filename = 'IMG_' . time() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('upload/profile/'), $filename);
                        $user->update([
                            "avatar" => $filename,
                        ]);
                    }

                    notify()->success('Profile uploaded successfully', 'success');
                    return redirect()->route('profile.index');
                } catch (\Throwable $th) {
                    Log::error($th->getMessage());
                    notify()->error('Profile upload failed', 'error');
                    return redirect()->back();
                }
                break;

            case 'remove':
                try {
                    $user = User::findOrFail($request->user_id);
                    // dd($user);
                    if ($user->avatar) {
                        // dd('hello');
                        @unlink(public_path('upload/profile/' . $user->avatar));
                        $user->update([
                            'avatar' => null
                        ]);
                    }
                    notify()->success('Profile remove successfully', 'Success');
                    return redirect()->route('profile.index');
                } catch (\Throwable $th) {
                    Log::error($th->getMessage());
                    notify()->error('Profile remove failed', 'error');
                    return redirect()->back();
                }
                break;
        }
    }

}
