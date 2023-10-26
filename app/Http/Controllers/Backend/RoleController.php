<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('roles.index');

        $roles = Role::all();
        return view('backend.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('roles.create');

        $modules = Module::all();
        return view('backend.role.form',compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('roles.create');

        $this->validate($request,[
            'name'          => 'required|unique:roles,name',
            'permissions'   => 'required|array',
            'permissions.*' => 'integer'
        ]);

        Role::create([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name),
        ])->permissions()->sync(
            $request->input('permissions'),[]
        );

        notify()->success("Role create successfully.", "Success");
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        Gate::authorize('roles.edit');

        $modules = Module::all();
        return view('backend.role.form',compact('modules','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        Gate::authorize('roles.edit');

        $role->update([
            'name'  =>  $request->name,
            'slug'  =>  Str::slug($request->name)
        ]);

        $role->permissions()->sync(
            $request->input('permissions')
        );

        notify()->success("Role update successfully.", "Success");
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        Gate::authorize('roles.destroy');

        if ($role->deletable) {
            $role->delete();
            notify()->success("Role delete successfully.", "Deleted");
        }else{
            notify()->error("You can't delete system role","Error");
        }
        return back();
    }
}
