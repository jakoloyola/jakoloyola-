<?php

namespace App\Http\Controllers;

use Hash;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserFacility;
use App\Models\UserRole;

class UserController extends Controller
{
    
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('username', 'password'))) {
        return response()->json([
        'message' => 'Invalid login details'
                ], 401);
            }

        $user = User::where('username', $request['username'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
        ]);
    }
    

    public function index()
    {        
        $users = User::with('user_facilities.facility')
            ->with('user_roles.role')
            ->latest()->paginate(10);
        
        return response()->json($users);
    }

    public function store(Request $request)
    {        
        $validator = Validator::make($request->all(), 
            [
                'name' => 'required',
                'username' => 'required|min:4|unique:users,username',
                'password' => 'required|min:6',
                'confirm_password' => 'required_with:password|same:password|min:6',
            ]
        );

        if ($validator->fails()) {
           return response()->json($validator->errors(), 422);
        }
    
        if($request['password'] != ''){
            $request['password'] = Hash::make($request['password']);
        }

        if($user = User::create($request->all())){            

            if(!empty($request['roles'])){
                foreach($request['roles'] as $role){
                    $data = [
                        'user_id' => $user->id,
                        'role_id' => $role,
                    ];

                    UserRole::create($data);
                }
            }
            
            if(!empty($request['facilities'])){
                foreach($request['facilities'] as $facility){
                    $data = [
                        'user_id' => $user->id,
                        'facility_id' => $facility,
                    ];

                    UserFacility::create($data);
                }
            }

            return response()->json('success');
        }

    }

    public function update(Request $request, User $userId)
    {
        
        $validator = Validator::make($request->all(), 
            [
                'name' => 'required',
                'username' => ['required','min:4', Rule::unique('users')->ignore($userId, 'id')],
                'password' => 'min:6',
                'confirm_password' => 'required_with:password|same:password|min:6',
            ]
        );

        if ($validator->fails()) {
           return response()->json($validator->errors(), 422);
        }
    
        if($request['password'] != ''){
            $request['password'] = Hash::make($request['password']);
        }

        $user = User::find($userId)->first();

        if($user->update($request->all())){
            return response()->json('success');
        }
    }
    
    public function show(Request $request, User $userId)
    {        
        $user = User::with('user_facilities.facility')
            ->with('user_roles.role')
            ->find($userId)->first();
        
        return response()->json($user);
    }
    
    public function destroy(User $userId)
    {
        $user = User::find($userId)->first();
        if($user->delete()){            
            return response()->json('success');
        }
    }
}
