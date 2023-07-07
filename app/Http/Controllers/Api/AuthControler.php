<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Login;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Validation\Rules\Password;



class AuthControler extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:logins,email',
            'password' => 'required|min:8',
            'User_ID' => 'required|unique:logins,User_ID',
        ]);

        $login = Login::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'User_ID' => $request->User_ID,
        ]);

        Auth::login($login);

        return redirect('/dashboard');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $login = $user->login;
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'user' => $user,
                'login' => $login,
                'access_token' => $token,
            ]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
        ]);

        $user = $request->user();
        $login = $user->login;

        if (!password_verify($request->old_password, $login->password)) {
            return response()->json(['error' => 'Incorrect old password.'], 400);
        }

        $login->update([
            'password' => bcrypt($request->new_password),
        ]);

        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Password changed successfully.']);
    }
}
