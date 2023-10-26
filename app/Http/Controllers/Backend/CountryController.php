<?php

namespace App\Http\Controllers\Backend;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class CountryController extends Controller
{
    public function index()
    {
        Gate::authorize('countries.index');

        $countries = Country::orderBy('name','asc')->get();
        return view('backend.country.index',compact('countries'));
    }
}
