<?php

namespace App\Http\Controllers;

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class LinkedInController extends Controller
{
    private $api;
    public function __construct(LinkedIn $li)
    {
        $this->middleware(function ($request, $next) use ($li) {
            // $fb->setDefaultAccessToken(Auth::user()->token);
            $this->api = $li;
            return $next($request);
        });
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
            $url .= "access_token=AQUi2Porkz7gQldgeRFnC-na7yO4fEVBPmy8sUvB0zMHZn5SWFvs4fLcOHwUvfG_KKqL9DTbg7IRDifSpq2KeAARFa0q-hXUN6cQcO1exYuEXYj6thJAF3L57ODUv6U4oFzuyKTxKLKWtDdXht0GSQkNB0IlVhIJQwdHKqYBfr_hU2OOyp0zAMWXIdT6gZyxPnRo31EwFSdwBcHPrsq3LpBq78XwAI0pYtLRWsSB4MjYtEByNh1XfmO4RvmGlo7IYAvprrj435_9r4HcvTyWJttUK5tcjW_don8L8lbQ129rrYuTTmKvIGwk9F3o-pwy7U9N_AwNqbZGj38K0uSZoVdACgCh8w";

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
            echo 'LinkedInServiceProvider SDK returned an error: ' . $e->getMessage();
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
        } catch (LinkedInSDKException $e) {
            dd($e); // handle exception
        }
    }

    public function publishToPageli(Request $request){

        $page_id = '74503391';

        // dd($this->getPageAccessToken($page_id));

        $page_token = "AQUi2Porkz7gQldgeRFnC-na7yO4fEVBPmy8sUvB0zMHZn5SWFvs4fLcOHwUvfG_KKqL9DTbg7IRDifSpq2KeAARFa0q-hXUN6cQcO1exYuEXYj6thJAF3L57ODUv6U4oFzuyKTxKLKWtDdXht0GSQkNB0IlVhIJQwdHKqYBfr_hU2OOyp0zAMWXIdT6gZyxPnRo31EwFSdwBcHPrsq3LpBq78XwAI0pYtLRWsSB4MjYtEByNh1XfmO4RvmGlo7IYAvprrj435_9r4HcvTyWJttUK5tcjW_don8L8lbQ129rrYuTTmKvIGwk9F3o-pwy7U9N_AwNqbZGj38K0uSZoVdACgCh8w";
        $url = "https://graph.facebook.com/$page_id/feed";
        $url .= "?link=" . $request->link;
        $url .= "&access_token=$page_token";

        $response = (new Client())->post($url);
    }
}
