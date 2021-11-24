<?php

namespace App\Http\Controllers;

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GraphController extends Controller
{
    /** @var Facebook */
    private $api;
    public function __construct(Facebook $fb)
    {
        $this->middleware(function ($request, $next) use ($fb) {
            // $fb->setDefaultAccessToken(Auth::user()->token);
            $this->api = $fb;
            return $next($request);
        });
    }

    public function retrieveUserProfile(){
        try {

            $params = "first_name,last_name,age_range,gender";

            $user = $this->api->get('/me?fields='.$params)->getGraphUser();

            dd($user);

        } catch (FacebookSDKException $e) {

        }

    }

    public function publishToProfile(Request $request){

        try {
            $response = $this->api->post('/me/feed', [
                'message' => $request->message
            ])->getGraphNode()->asArray();
            if($response['id']){
                // post created
            }
        } catch (FacebookSDKException $e) {
            dd($e); // handle exception
        }
    }

    public function getPageAccessToken($page_id){
        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
//            $app_id = env("FACEBOOK_APP_ID");
//            $app_secret = env("FACEBOOK_APP_SECRET");
//            $short_token = "EAAOZB6ZCDsEt0BAGy3v8MS3lZAZCE7OVJrkgobSlTwpixAGvTOUjbxzNyKsGhShlL1KAz6TyxzBYueZAwXp9ZAYNOqILt8aQSYPsSdFArTkSEStiDRzOZCfOtZCsTVOYd86ko4IlfmhkZAZCxdx7acJnZBnBQzqurneWphGOkTWUcbEGA6pDfvSxPXRWfKCv3Gj79JBCEb6bZAaNac7aATko6R8sLdZBilIf55Lq1XKn2dYQghGiiUJ7rEeBWZCCG1l34j9AUZD";
//            $url = "https://graph.facebook.com/oauth/access_token?grant_type=fb_exchange_token&";
//            $url .= "client_id=$app_id&";
//            $url .= "client_secret=$app_secret&";
//            $url .= "fb_exchange_token=$short_token";
//            $response = (new Client())->get($url);
//            dd(json_decode($response->getBody()));

            $url = "https://graph.facebook.com/$page_id?";
            $url .= "fields=access_token&";
            $url .= "access_token=EAAOZB6ZCDsEt0BAJ4m4GAYhvMkAemavZC8QoG50PC2BZC9xPgD2cklVvcWci5cOOuMybOJCz9gSuA5ZBE0LwSsqLfjyrBYNirBZCOq8IDYxCgN5fpJxrfMURRQ4apg2kwF7CktCwVwHMZCytZBOxxwx8NDtvlE9fMblAOUrZAlmqBovanbwnHSffutTpCJWrSXQMZD";

            $response = (new Client())->get($url);
            dd(json_decode($response->getBody())->access_token);
        }
        catch(FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(FacebookSDKException $e) {
            dd($e);
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        try {
            $pages = $response->getGraphEdge()->asArray();
            dd($pages);
            foreach ($pages as $key) {
                if ($key['id'] == $page_id) {
                    return $key['access_token'];
                }
            }
        } catch (FacebookSDKException $e) {
            dd($e); // handle exception
        }
    }

    public function publishToPage(Request $request){

        $page_id = '2010348462570698';

        // dd($this->getPageAccessToken($page_id));

        try {
//            $page_token = "";
//            $url = "https://graph.facebook.com/$page_id/feed";
//            $url .= "?link=" . $request->link;
//            $url .= "&access_token=$page_token";
//
//            $response = (new Client())->post($url);
            //dd(json_decode($response->getBody()));

    } catch (FacebookSDKException $e) {
            dd($e); // handle exception
        }
    }
}
