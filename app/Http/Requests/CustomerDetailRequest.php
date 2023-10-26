<?php

namespace App\Http\Requests;

use App\Rules\BinNumberLength;
use App\Rules\NidNumberLength;
use Illuminate\Foundation\Http\FormRequest;

class CustomerDetailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'company_name' => 'required',
            'nature' => 'required',
            'nid_no' => ['required', new NidNumberLength],
            'erc_no' => 'required',
            'erc_expiry_date' => 'required',
            'bin_no' => ['required',new BinNumberLength],
            'bin_expiry_date' => 'required',
            'tin_no' => 'required | min:12',
            'tin_expiry_date' => 'required',
            'trade_no' => 'required | digits_between:6,10',
            'trade_expiry_date' => 'required',
            'nid_file' => 'required|mimes:pdf',
            'erc_file' => 'required|mimes:pdf',
            'bin_file' => 'required|mimes:pdf',
            'tin_file' => 'required|mimes:pdf',
            'trade_file' => 'required|mimes:pdf',
        ];
    }
}
