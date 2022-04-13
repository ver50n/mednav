<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function register(Request $request)
    {
        session_start();
        $fbCallbackUrl = route('sns.fb-callback');

        $fb = new \Facebook\Facebook([
            'app_id' => config('sns_account.fb.app_id'),
            'app_secret' => config('sns_account.fb.app_secret'),
            'default_graph_version' => config('sns_account.fb.graph_version'),
        ]);

        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email']; // Optional permissions
        $fbLoginUrl = $helper->getLoginUrl($fbCallbackUrl, $permissions);

        $gmailCallbackUrl = route('sns.gmail-callback');
        $gmailAppId = config('sns_account.gmail.app_id');
        $gmailLoginUrl = "https://accounts.google.com/o/oauth2/v2/auth?scope=".urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email')."&redirect_uri=".urlencode($gmailCallbackUrl)."&response_type=code&client_id=$gmailAppId&access_type=online";

        return view('pages.register', [
            'fbLoginUrl' => $fbLoginUrl,
            'gmailLoginUrl' => $gmailLoginUrl
        ]);
    }

    public function registerPost(Request $request)
    {
        $data = $request->all();
        $user = new \App\Models\User();

        $validator = $user->register($data);

        if($validator === true) {
            return redirect()
                ->back()
                ->with('success', 'email-registration-succeed');
        }

        return redirect()
            ->back()
            ->with('error', 'email-registration-failed')
            ->withInput($data)
            ->withErrors($validator);
    }

    public function activationPost(Request $request)
    {
        $id = $request->id;
        $data = $request->all();
        $user = \App\Models\User::find($id);

        $validator = $user->activation($data);

        if($validator === true) {
            return redirect()->route('login')
                ->with('success', 'email-activation-succeed');
        }

        return redirect()
            ->route('login')
            ->with('error', 'email-activation-failed')
            ->withInput($data)
            ->withErrors($validator);
    }
}
