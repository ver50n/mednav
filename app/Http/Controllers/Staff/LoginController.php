<?php

namespace App\Http\Controllers\Staff;

use Auth;
use Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::guard('web')->check())
            return redirect()->route('staff.dashboard');

        return view('staff.login', [
        ]);
    }

    public function loginPost(Request $request)
    {
        if(Auth::guard('web')->check())
            return redirect()->route('staff.dashboard');
            
        $rules = [
            'username' => [
                'required',
                Rule::exists('users')
            ],
            'password' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        $credentials = $request->only('username', 'password');

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('staff.dashboard');
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
        Auth::guard('web')->logout();
        return redirect()->route('staff.dashboard');
    }
}
