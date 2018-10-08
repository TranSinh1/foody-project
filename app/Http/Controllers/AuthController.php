<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Carbon\Carbon;
use App\Notifications\SignupActivate;


class AuthController extends Controller
{
    public function signup (Request $request)
    {
        $this->validate($request, [
            'email' => 'required|min:3|string|email|unique:users',
            'name' => 'required|string',
            'password' => 'required|confirmed',
            'phone' => 'required|min:10',
            'address' => 'required|string|min:3'
        ]);

        $user = new user([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'activation_token' => str_random(60)
        ]);
        $user->save();
        $user->notify(new SignupActivate($user));

        return response()->json([
            'message' => config('user.created')
        ], 201);
    }

    public function login (Request $request)
    {
        $this->validate($request, [
            'email' => 'required|min:3|string|email',
            'password' => 'required',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);
        $credentials['active'] = 1;
        $credentials['deleted_at'] = null;
        if(! Auth::attempt($credentials)) {

            return response()->json([
                'message' => config('user.unauthorized')
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    public function logout (request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => config('user.logout')
        ]);
    }

    public function currentUser (Request $request)
    {
        $user = $request->user();

        return response()->json(compact($user));
    }

    public function signupActivate($token)
    {
        $user = User::where('activation_token', $token)->first();
        if (! $user) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }
        $user->active = true;
        $user->activation_token = '';
        $user->save();

        return $user;
    }
}
