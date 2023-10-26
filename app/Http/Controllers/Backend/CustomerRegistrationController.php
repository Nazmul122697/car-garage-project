<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\RegistrationRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserOtp;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class CustomerRegistrationController extends Controller
{


    public function registerValidation(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'size:11', 'regex:/(01)[0-9]{9}/', 'unique:' . User::class],
            'district' => ['required'],
            'division' => ['required'],
        ]);
        try {
            $user = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'district' => $request->district,
                'division' => $request->division,
            ];
            Session::put('user',$user);
            $otp = random_int(1000, 9999);
            $userOtp = UserOtp::where('email',$request->email)
                        ->where('phone',$request->phone)->first();
            // dd($userOtp);
            $expirationTime = Carbon::now()->addSeconds(120);
            // // dd($expirationTime);
            if($userOtp != null){
                $userOtp->update([
                    'otp' => $otp,
                    'expire_at' => $expirationTime,
                ]);
            }else{
                $userOtp = UserOtp::create([
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'otp' => $otp,
                    'expire_at' => $expirationTime,
                ]);
            }

            Session::put('user_otp_id',$userOtp->id);

            $this->sendSms($request->phone, $otp);

            // $bdCode = '+88';
            // $maskedNumber = substr_replace($request->phone, '****', 5, 4);
            // $formattedNumber = '+88' . $maskedNumber;

            // return view('backend.auth.otp.index', compact('formattedNumber','userOtp', 'otp', 'expirationTime'));
            $curentRoute = Route::getFacadeRoot()->current()->uri();
            return redirect()->route('otp.index',['auth'=> session()->get('user.name'),'returnUrl'=> $curentRoute]);



        } catch (Exception $exception) {
            session()->flash('error', 'Sorry! Something went wrong!!');
            dd($exception->getMessage());
            return redirect()->back()->withInput();
        }

        // return redirect()->back();
    }

    public function resendOtp(Request $request)
    {
        // dd($request->all());
        $userOtp = UserOtp::findOrFail($request->id);
        // dd($userOtp);
        $otp = random_int(1000, 9999);
        $expirationTime = Carbon::now()->addSeconds(120);
        $userOtp->update([
            'otp' => $otp,
            'expire_at' => $expirationTime
        ]);

        // dd($userOtp->toArray());
        $curentRoute = Route::getFacadeRoot()->current()->uri();
        return redirect()->route('otp.index',['auth'=> session()->get('user.name'),'returnUrl'=> $curentRoute]);

        // Session::put('session_otp', $otp);
        // $this->sendSms(session()->get('user.phone'), $otp);
        // return response()->json($otp);
    }


    protected function sendSms($phoneno, $messageBody)
    {
        $url = "http://103.53.84.5:1222/sendtext?apikey=d23583bbd5258301&secretkey=f9844d4f&callerID=8801922002381&toUser=88" . $phoneno . "&messageContent=" . urlencode($messageBody);
        return Self::smsApi($url);
    }

    protected function smsApi($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }
}
