<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Utils\SnsLoginUtil;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SnsController extends Controller
{
    public function gmailCallback(Request $request)
    {
        session_start();
        $code = $request->code;

        $accessToken = SnsLoginUtil::getGmailUserToken($code);
        $gmailUser = SnsLoginUtil::getGmailUserData($accessToken);

        $user = $this->userCheckbySns('gmail', $gmailUser, $accessToken);
        if(\Auth::loginUsingId($user->id)) {
            \Session::put('locale', $user->default_language);
            return redirect('/home');
        }
    }

    public function fbCallback(Request $request)
    {
        session_start();
        $code = $request->code;

        $accessToken = SnsLoginUtil::getFbUserToken($code);
        $fbUser = SnsLoginUtil::getFbUserData($accessToken);

        $user = $this->userCheckbySns('fb', $fbUser, $accessToken);

        if(\Auth::loginUsingId($user->id)) {
            \Session::put('locale', $user->default_language);
            return redirect('/home');
        }
    }


    private function userCheckbySns($provider, $providerData, $accessToken)
    {
        $user = User::where('email', $providerData['email'])
            ->first();

        if(!$user) {
            $user = new User();
            $user->name = $providerData['name'];
            $user->email = $providerData['email'];
            $user->slug = \App\Utils\StringUtil::uniqueSlug($user->email);
            $user->country_code = config('app.country_code');
            $user->is_active = 1;
        }

        switch($provider) {
            case 'fb':
                $user->fb_uid = $providerData['id'];
                $user->fb_token = $accessToken;
                break;
            case 'gmail':
                $user->gmail_uid = $providerData['id'];
                $user->gmail_token = $accessToken;
                break;
        }

        $user->save();
        $user->setLoginInfo();
        
        return $user;
    }
}
