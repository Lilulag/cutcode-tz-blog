<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;

class AuthController extends Controller
{
    public function login ()
    {
        return view('admin.auth.login');
    }

    public function login_action (LoginRequest $request)
    {
        $data = $request->validated();

        if (auth('admin')->attempt($data)) {
            return redirect(route('admin.articles.index'));
        };

        return $data;
    }

    public function logout_action ()
    {
        auth('admin')->logout();

        return redirect(route('admin.login'));
    }
}
