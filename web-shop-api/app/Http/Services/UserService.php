<?php
namespace App\Http\Services;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserService
{
    public static function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $resp['access_token'] = $user->createToken('MyApp')->accessToken;
            return ResponseService::make(true, 'Successfully logged in', $resp);
        }
        abort(403, 'Wrong credentials');
        return ResponseService::make(false, 'Wrong credentials');
    }

    public static function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            abort(400, $validator->errors());

        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        return ResponseService::make(true, 'Registered successfully', ['access_token' => $user->createToken('MyApp')->accessToken]);
    }

    public static function get($id = null)
    {
        if ($id == null) {
            return Auth::user();
        }
    }

    public static function changePassword($old, $new)
    {
        $user = self::get();
        if (Hash::check($old, $user->password)) {
            $user->password = Hash::make($new);
            if ($user->save()) {
                return ResponseService::make(true, 'Password changed');
            }
        }
        abort(400, 'Passwords do not match');
    }
}
