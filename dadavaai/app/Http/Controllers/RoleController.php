<?php

namespace App\Http\Controllers;

use App\User;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;
use DB;


class RoleController extends Controller
{
    

    public function setRoleAndPermission(Request $request)
    {

        

        $user = User::find($request->user_id);
        $role = Role::find($request->role_id);

        foreach ($user->roles as $key => $r) {
                $user->removeRole($r);
            }

        $user->assignRole($role);

       if ($request->permission_id) {

            foreach ($user->permissions as $key => $permission) {
                $user->revokePermissionTo($permission);
            }
                
           foreach ($request->permission_id as $id){
                $permission = Permission::find($id);
                $user->givePermissionTo($permission);
            }
        }

        return $user;
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users',compact('users','roles', 'permissions'));
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function permissions()
    {
        $permissions = Permission::all();
        return view('admin.permissions',compact('permissions'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $role = Role::find(1);
            
        // $permission = Permission::find(1);
        // $role->givePermissionTo($permission);
            
        // $role = Role::create(['name' => 'Super admin']);
        // Auth()->user()->assignRole($role);
        // $role = Role::find(1);

        // Auth()->user()->removeRole($role);

        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.roles',compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created Permission resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function permissionStore(Request $request)
    {
        
        // Validate form data
        $rules = array(
            'permissionName' => 'required',

        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{

            // Create instance of role model & assign form value then save to database
            $permission = Permission::create(['name' => $request->permissionName]);

            return response()->json($permission);
        }
    }


    /**
     * Store a newly created Role resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        // Validate form data
        $rules = array(
            'roleName' => 'required',

        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{

            // Create instance of role model & assign form value then save to database
            $role = Role::create(['name' => $request->roleName]);

            if ($request->permission_id) {
                foreach ($request->permission_id as $id){

                $permission = Permission::find($id);
                $role->givePermissionTo($permission);
            }
            }
            

            return response()->json($role);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

        // Validate form data
        $rules = array(
            'roleName' => 'required',

        );

        $validator = Validator::make ( Input::all(), $rules);
        if ($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        else{

            // Create instance of role model & assign form value then save to database
            $role = Role::find($id);

            if ($request->permission_id) {

                foreach ($role->permissions as $key => $permission) {
                    $role->revokePermissionTo($permission);
                }
                

                foreach ($request->permission_id as $id){

                    $permission = Permission::find($id);
                    $role->givePermissionTo($permission);
                }
            }
            

            return response()->json($role);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role, $id)
    {
        $role = Role::find ($id);
        $role->delete();

        return response()->json($role);
    }
}
