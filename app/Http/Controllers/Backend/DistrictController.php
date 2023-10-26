<?php

namespace App\Http\Controllers\Backend;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class DistrictController extends Controller
{
    public function index()
    {
        Gate::authorize('districts.index');

        $districts = District::with('division:id,name')->orderby('name', 'ASC')->get();
        return view('backend.district.index', compact("districts"));
    }


}
