<?php

namespace App\Http\Controllers\Backend;

use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class DivisionController extends Controller
{

    public function index()
    {
        Gate::authorize('divisions.index');

        $divisions = Division::orderBy('name', 'asc')->get();
        return view('backend.division.index', compact('divisions'));
    }

}
