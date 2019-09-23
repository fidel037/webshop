<?php
namespace App\Services;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserService
{
    public static function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['access_token'] = $user->createToken('MyApp')->accessToken;
            return $success;
        }
        return abort(403, 'Wrong credentials');
    }

    public static function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['access_token'] = $user->createToken('MyApp')->accessToken;
        return $success;
    }

    public static function get($id = null) {
        if ($id == null) {
            return Auth::user();
        }
    }
}
