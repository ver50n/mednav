<?php
namespace App\Utils;

use Lang;
use \Firebase\JWT\JWT;

class SnsLoginUtil
{
    public static function getGmailUserToken($code)
    {
        $url = 'https://www.googleapis.com/oauth2/v4/token';
        $gmailCallbackUrl = route('sns.gmail-callback');
        $accessToken = null;

        $gmailAppId = config('sns_account.gmail.app_id');
        $gmailAppSecret = config('sns_account.gmail.app_secret');

        $curlPost = "client_id=$gmailAppId&redirect_uri=$gmailCallbackUrl&client_secret=$gmailAppSecret&code=$code&grant_type=authorization_code";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = json_decode(curl_exec($ch), true);
        $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);

        if($http_code != 200)
            throw new \Exception('Error : Failed to receieve access token');
        $accessToken = $data['access_token'];

        return $accessToken;
    }

    public static function getGmailUserData($accessToken)
    {
        $url = 'https://www.googleapis.com/oauth2/v2/userinfo?fields=name,email,gender,id,picture,verified_email';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $accessToken));
        $gmailUser = json_decode(curl_exec($ch), true);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if($http_code != 200)
          throw new Exception('Error : Failed to get user information');

        return $gmailUser;
    }

    public static function getFbUserToken($code)
    {
        $accessToken = null;

        $fb = new \Facebook\Facebook([
            'app_id' => config('sns_account.fb.app_id'),
            'app_secret' => config('sns_account.fb.app_secret'),
            'default_graph_version' => config('sns_account.fb.graph_version'),
        ]);

        $helper = $fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        return $accessToken;
    }

    public static function getFbUserData($accessToken)
    {
        $fb = new \Facebook\Facebook([
            'app_id' => config('sns_account.fb.app_id'),
            'app_secret' => config('sns_account.fb.app_secret'),
            'default_graph_version' => config('sns_account.fb.graph_version'),
        ]);
        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }

        $response = $fb->get('/me?fields=id,name,email,picture', $accessToken);
        $fbUser = $response->getGraphUser();
        
        return $fbUser;
    }

    public static function getFbLoginUrl()
    {
        $fbCallbackUrl = route('sns.fb-callback');

        $fb = new \Facebook\Facebook([
            'app_id' => config('sns_account.fb.app_id'),
            'app_secret' => config('sns_account.fb.app_secret'),
            'default_graph_version' => config('sns_account.fb.graph_version'),
        ]);

        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email']; // Optional permissions
        $fbLoginUrl = $helper->getLoginUrl($fbCallbackUrl, $permissions);
        
        return $fbLoginUrl;
    }

    public static function getGmailLoginUrl()
    {
        $gmailCallbackUrl = route('sns.gmail-callback');
        $gmailAppId = config('sns_account.gmail.app_id');

        $gmailLoginUrl = "https://accounts.google.com/o/oauth2/v2/auth?scope=".urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email')."&redirect_uri=".urlencode($gmailCallbackUrl)."&response_type=code&client_id=$gmailAppId&access_type=online";
        return $gmailLoginUrl;
    }
}
