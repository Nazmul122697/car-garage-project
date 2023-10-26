<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\RegistrationVerificationMail;
use App\Models\District;
use App\Models\Division;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class OTPController extends Controller
{
    public function index(Request $request)
    {
        // dd(Session::get('user'));
        $userOtp = UserOtp::findOrFail(Session::get('user_otp_id'));
        $otp = $userOtp->otp;
        $phone = Session::get('user.phone');
        $bdCode = '+88';
        $maskedNumber = substr_replace($phone, '****', 5, 4);
        $formattedNumber = '+88' . $maskedNumber;
        $expirationTime = $userOtp->expire_at;

        return view('backend.auth.otp.index', compact('formattedNumber', 'otp', 'userOtp', 'expirationTime'));
    }
    public function verifyOtp(Request $request)
    {
        // dd($request->all());
        $user = Session::get('user');
        $password = rand(100000, 999999);
        $userOtp = UserOtp::findOrFail($request->id);

        if ($request->otp_digit == $userOtp->otp) {
            $userStore = User::create([
                'role_id' => 2,
                'name' => $user['name'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'division' => $user['division'],
                'district' => $user['district'],
                'password' => Hash::make($password),
                'status' => 1,
            ]);
            $userOtp->update([
                'varified' => 1,
            ]);

            Session::put('verify_auth_email',$userStore->email);
            $token = Password::createToken($userStore);
            $resetPasswordLink = route('password.reset', ['token' => $token]). '?email=' . urlencode($userStore->email);
            $data =[
                'name' => $userStore->name,
                'email' => $userStore->email,
                'phone' => $userStore->phone,
                'password' => $password,
                'reset_link' => $resetPasswordLink,
            ];

            // Mail::to($userStore->email)->send(new RegistrationVerificationMail($data));
            Mail::send('backend.mail.registration', $data, function ($message) use ($data) {
                $message->from(env('MAIL_FROM_ADDRESS'), 'Bangladesh Food Safety Authority');
                $message->to($data['email']);
                $message->subject('Registration Verification Mail!');
            });
            Session::forget('user');
            Session::forget('user_otp_id');
            return response()->json(['message' => 'success'], 200);
        } else {
            return response()->json(['message' => 'OTP not matched'], 404);
        }
    }

    public function removeOtpSession()
    {
        if(Session::has('session_otp')){
            Session::forget('session_otp');
            return response()->json(['message' => 'Session removed successfully.']);
        }
    }

    public function checkMail()
    {
        $verifyAuthEmail = Session::get('verify_auth_email');
        $maskedEmail = substr_replace($verifyAuthEmail, '****', 3, 4);
        // dd($maskedemail);
        return view('backend.auth.otp.check_mail', compact('maskedEmail'));
        // return view('email.register_password');
    }


    public function getDistrict(Request $request)
    {
        $districts = District::where('division_id', $request->division_id)->orderBy('name', 'asc')->get();
        return response()->json($districts);
    }
}
