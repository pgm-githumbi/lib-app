<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Traits\AuthorizationNames;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;

class AuthController extends Controller
{
    use HttpResponses, AuthorizationNames;
    public function login(LoginUserRequest $request){
        $request->validated($request->all());

        if(!Auth::attempt($request->only('email', 'password'))){
            Log::info('', ['email'=> $request->email, 'password'=> $request->password]); 
            return $this->error('', 'Wrong username or password', 401);
        }

        Log::info('', ['email'=> $request->email]); 
        $user = User::where('email', $request->email)->first();
        if(Hash::check($request->password,$user->password)){
            return $this->success([
                "user" => $user,
                "token" => $user->createToken('Api token of '.$user->name)->plainTextToken
            ], "you're officially logged in");
            
        }

        return $this->error('', "Internal server error");
    }
    
    public function register(StoreUserRequest $request){
         Log::info("Registering the user...");
         $request->validated($request->all());
         Log::info("Request validated ");
         Log::info("Request validated: ", ["req" => $request->json()]);

         $user = User::create([
            "name"=> $request->name,
            "email"=> $request->email,
            "password"=> Hash::make($request->password),
         ]);
         $user->save();

        //  Role::findOrCreate($this->roleNames['student']);
        //  $user->assignRole($this->roleNames['student']);

         return $this->success([
            "user" => $user,
            "token"=> $user->createToken('Api token of '.$user->name)->plainTextToken,
         ],
        "Successfully registered user ".$user->name);
    }

    public function logout(){
        $user = Auth::user();
        $user->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out', 'user' => $user]);
    }

}
