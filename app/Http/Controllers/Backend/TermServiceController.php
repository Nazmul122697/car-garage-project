<?php

namespace App\Http\Controllers\Backend;

use App\Models\TermService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class TermServiceController extends Controller
{

    public function index()
    {
        Gate::authorize('term-services.index');

        $termService = TermService::first();
        return view('backend.terms_service.index',compact('termService'));
    }


    public function update(Request $request, $id)
    {
        Gate::authorize('term-services.index');

        $request->validate([
            'description' => 'required',
            'description_bn' => 'required',
        ]);

        try {
            $termService =TermService::findOrFail($id);
            $termService->update([
                'description' => $request->description,
                'description_bn' => $request->description_bn,
            ]);
            notify()->success('Term of services updated successfully','success');
            return redirect()->route('term-services.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Term of services update failed','error');
            return redirect()->route('term-services.index');

        }
    }


}
