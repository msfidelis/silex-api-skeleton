<?php

namespace App\Providers;

use Silex\Application;
use Silex\ControllerProviderInterface;

/**
 * exemplo de Provider de recursos do Facebook
 * @link: Explorer API https://developers.facebook.com/tools/explorer/
 * @link: SO API Facebok: http://stackoverflow.com/questions/7818667/simple-example-to-post-to-a-facebook-fan-page-via-php
 * @link: Post API Facbeook http://www.pontikis.net/blog/auto_post_on_facebook_with_php
 * @link: POst Graph API: https://developers.facebook.com/docs/php/howto/postwithgraphapi
 * @author Matheus Fidelis
 * @email msfidelis01@gmail.com
 * @date 17/10/2016
 */
class FacebookProvider implements ControllerProviderInterface {

  private $pageID = "3376";
  private $appID = "1706075452";
  private $appKey = "1fe2de24eba3a944f09a9";
  private $accessToken = "ZBbuZCtXHS7n4xZAebpyABkXuW2NUVeNfbXp9sVVMOsa9Lf5IcJZAPIS5L6RCYMhAiCVzPr1R0WaSZAMYrZAQoWvX6IB8kqyPOZBxUSvtGa4r6gf5gZDZD";

  public function getPageID() {
    return $this->pageID;
  }

  public function getAppID() {
    return $this->appID;
  }

  public function getAppKey() {
    return $this->appKey;
  }

  public function getAccessToken() {
    return $this->accessToken;
  }

  public function setPageID($pageID) {
    $this->pageID = $pageID;
  }

  public function setAppID($appID) {
    $this->appID = $appID;
  }

  public function setAppKey($appKey) {
    $this->appKey = $appKey;
  }

  public function setAccessToken($accessToken) {
    $this->accessToken = $accessToken;
  }


  public function connect(Application $app) {
    $controllers = $app['controllers_factory'];

    // Rota de postagem no Facbeook com os dados recebidos pelo request
    $controllers->post('/', function (Request $request)  use ($app) {
      $data = array(
        'picture' =>  $request->get('picture') ? $request->get('picture') : NULL,
        'link' => $request->get('link') ? $request->get('link') : NULL,
        'message' => $request->get('message') ? $request->get('message') : NULL,
        'caption' => $request->get('caption') ? $request->get('caption') : NULL,
        'description' => $request->get('description') ? $request->get('description') : NULL,
        'access_token' => $request->get('access_token') ? $request->get('access_token') : $this->accessToken,
      );

      $postURL = "https://graph.facebook.com/" . $request->get('pageID') . "/feed";

      try {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $postURL);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($curl);
      } catch (Exception $ex) {
        $return = $app->json($ex);
      }

      return $app->json($return);
    });

    return $controllers;
  }
}
