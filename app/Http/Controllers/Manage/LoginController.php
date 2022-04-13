<?php

namespace App\Http\Controllers\Manage;

use Auth;
use Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        return view('manage.login', [
        ]);
    }

    public function loginPost(Request $request)
    {
        $rules = [
            'username' => [
                'required',
                Rule::exists('admins')
            ],
            'password' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        $credentials = $request->only('username', 'password');

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('manage.dashboard');
        } else {
            $error = \Illuminate\Validation\ValidationException::withMessages([
               'password' => ['Login Error'],
            ]);
            throw $error;
            return redirect()->back()->withErrors($validator);
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('manage.dashboard');
    }
}
