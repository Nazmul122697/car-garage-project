<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerDetailRequest;
use App\Models\CustomerDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CustomerDetailController extends Controller
{
    public function store(CustomerDetailRequest $request)
    {
        // dd($request->all());

        try {

            // dd($request->all());
            CustomerDetails::create([
                'customer_id' => Auth::user()->id,
                'company_name' => $request->company_name,
                'nature' => $request->nature,
                'nid_no' => $request->nid_no,
                'erc_no' => $request->erc_no,
                'erc_expiry_date' => $request->erc_expiry_date,
                'bin_no' => $request->bin_no,
                'bin_expiry_date' => $request->bin_expiry_date,
                'tin_no' => $request->tin_no,
                'tin_expiry_date' => $request->tin_expiry_date,
                'trade_no' => $request->trade_no,
                'trade_expiry_date' => $request->trade_expiry_date,
                'nid_file' => $this->uploadFile($request, 'nid', 'nid_file'),
                'erc_file' => $this->uploadFile($request, 'erc', 'erc_file'),
                'bin_file' => $this->uploadFile($request, 'bin', 'bin_file'),
                'tin_file' => $this->uploadFile($request, 'tin', 'tin_file'),
                'trade_file' => $this->uploadFile($request, 'trade_license', 'trade_file'),
            ]);
            Session::forget('customer_incomplete');
            notify()->success('Customer Details Updated Successfully', 'Success');
            return redirect()->route('dashboard');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Customer Details Update  Failed', 'Error');
            return back();
        }
    }

    private function uploadFile($request, string $type, string $key = null)
    {

        if ($request->hasFile($key)) {
            $file = $request->file($key);
            $destinationPath = 'upload/' . $type . '/';
            $fileName = $type . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            unset($file);
            return $fileName;
        }
        return $key;
    }


    public function download(Request $request)
    {
        $file = CustomerDetails::where('customer_id', Auth::user()->id)->first();
        if ($request->type == 'tin') {
            $fileContent = $file->tin_file;
            if (!$fileContent) {
                return abort(404);
            } else {
                return response()->download(public_path('upload/tin/' . $fileContent));
            }
        } elseif ($request->type == 'bin') {
            $fileContent = $file->bin_file;
            // dd($fileContent);
            if (!$fileContent) {
                return abort(404);
            } else {
                return response()->download(public_path('upload/bin/' . $fileContent));
            }
        } elseif ($request->type == 'trade_license') {
            $fileContent = $file->trade_file;
            // dd($fileContent);
            if (!$fileContent) {
                return abort(404);
            } else {
                return response()->download(public_path('upload/trade_license/' . $fileContent));
            }
        } elseif ($request->type == 'nid') {
            $fileContent = $file->nid_file;
            // dd($fileContent);
            if (!$fileContent) {
                return abort(404);
            } else {
                return response()->download(public_path('upload/nid/' . $fileContent));
            }
        }
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'company_name' => 'required',
            'nature' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'nid_no' => 'required',
            'erc_no' => 'required',
            'tin_no' => 'required',
            'bin_no' => 'required',
            'trade_no' => 'required',
            'erc_expiry_date' => 'required',
            'bin_expiry_date' => 'required',
            'tin_expiry_date' => 'required',
            'trade_expiry_date' => 'required',
            'nid_file' => 'nullable|mimes:pdf',
            'erc_file' => 'nullable|mimes:pdf',
            'bin_file' => 'nullable|mimes:pdf',
            'tin_file' => 'nullable|mimes:pdf',
            'trade_file' => 'nullable|mimes:pdf',
        ]); //
        // dd($request->all());

        try {
            $user = User::findOrFail(Auth::user()->id);
            $user->update([
                'name' => $request->name,
                'division' => $request->division,
                'district' => $request->district,
                'country' => $request->country,

            ]);
            // dd($user);
            $customer = CustomerDetails::where('customer_id',$user->id)->first();
            // dd($customer);

            $customer->update([
                'company_name' => $request->company_name,
                'nature' => $request->nature,
                'nid_no' => $request->nid_no,
                'erc_no' => $request->erc_no,
                'erc_expiry_date' => $request->erc_expiry_date,
                'bin_no' => $request->bin_no,
                'bin_expiry_date' => $request->bin_expiry_date,
                'tin_no' => $request->tin_no,
                'tin_expiry_date' => $request->tin_expiry_date,
                'trade_no' => $request->trade_no,
                'trade_expiry_date' => $request->trade_expiry_date,
            ]);

            //Customer profile Image/avatar
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/profile/' . $user->avatar));
                $filename = 'IMG_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/profile/'), $filename);
                $user->update([
                    "avatar" => $filename,
                ]);
            }

            //NID File
            if ($request->hasFile('nid_file')) {
                $file = $request->file('nid_file');
                @unlink(public_path('upload/nid/' . $customer->nid_file));
                $filename = 'Nid_pdf_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/nid/'), $filename);
                $customer->update([
                    "nid_file" => $filename,
                ]);
            }

            //ERC File
            if ($request->hasFile('erc_file')) {
                $file = $request->file('erc_file');
                @unlink(public_path('upload/erc/' . $customer->erc_file));
                $filename = 'Erc_pdf_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/erc/'), $filename);
                $customer->update([
                    "erc_file" => $filename,
                ]);
            }

            //BIN File
            if ($request->hasFile('bin_file')) {
                $file = $request->file('bin_file');
                @unlink(public_path('upload/bin/' . $customer->bin_file));
                $filename = 'Bin_pdf_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/bin/'), $filename);
                $customer->update([
                    "bin_file" => $filename,
                ]);
            }


            //TIN File
            if ($request->hasFile('tin_file')) {
                $file = $request->file('tin_file');
                @unlink(public_path('upload/tin/' . $customer->tin_file));
                $filename = 'Tin_pdf_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/tin/'), $filename);
                $customer->update([
                    "tin_file" => $filename,
                ]);
            }

            //Trade License
            if ($request->hasFile('trade_file')) {
                $file = $request->file('trade_file');
                @unlink(public_path('upload/trade_license/' . $customer->trade_file));
                $filename = 'Trade_license_pdf_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/trade_license/'), $filename);
                $customer->update([
                    "trade_file" => $filename,
                ]);
            }


            Session::forget('customer_incomplete');
            notify()->success('Customer Details Updated Successfully', 'Success');
            return redirect()->route('profile.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Customer Details Update  Failed', 'Error');
            return back();
        }
    }
}
