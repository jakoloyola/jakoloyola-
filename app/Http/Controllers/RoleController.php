<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{    

    public function index()
    {        
        $roles = Role::paginate(10);
        
        return response()->json($roles);
    }

    public function store(Request $request)
    {        
        $validator = Validator::make($request->all(), 
            [
                'name' => 'required|unique:roles,name',
            ]
        );

        if ($validator->fails()) {
           return response()->json($validator->errors(), 422);
        }

        if(Role::create($request->all())){
            return response()->json('success');
        }

    }

    public function update(Request $request, Role $roleId)
    {
        $validator = Validator::make($request->all(), 
            [
                'name' => 'required|unique:roles,name',
            ]
        );

        if ($validator->fails()) {
           return response()->json($validator->errors(), 422);
        }

        $role = Role::find($roleId)->first();

        if($role->update($request->all())){
            return response()->json('success');
        }
    }
    
    public function show(Request $request, Role $roleId)
    {        
        $role = Role::find($roleId)->first();
        
        return response()->json($role);
    }
    
    public function destroy(Role $roleId)
    {
        $role = Role::find($roleId)->first();
        if($role->delete()){            
            return response()->json('success');
        }
    }
}
