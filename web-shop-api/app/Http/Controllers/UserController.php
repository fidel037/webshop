<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return UserService::login();
    }

    /**
     * Register api
     * @param Request $request
     * @return mixed
     */
    public function register(Request $request)
    {
        return UserService::register($request);
    }

    public function get($id = null)
    {
        return UserService::get($id);
    }

    public function changePassword(Request $request)
    {
        $params = $request->all();
        return UserService::changePassword($params['oldP'], $params['newP']);
    }
}
