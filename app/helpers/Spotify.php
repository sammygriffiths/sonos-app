<?php

namespace Griff;

use GuzzleHttp\Client as GuzzleClient;


class Spotify
{
  public static function getAccessToken()
  {
    if (!Cache::get_instance()->get('access_token')) {
      return self::refreshAccessToken();
    }
    return Cache::get_instance()->get('access_token');
  }

  public static function refreshAccessToken()
  {
    $refresh_token = Cache::get_instance()->get('refresh_token');
    $client = new GuzzleClient();
    $access_token = $client->request('POST', 'https://accounts.spotify.com/api/token', [
      'form_params' => [
        'grant_type' => 'refresh_token',
        'refresh_token' => $refresh_token
      ],
      'headers' => [
        'Authorization' => 'Basic ***REMOVED***'
      ]
    ])->getBody()->getContents();

    $access_token = json_decode($access_token);
    Cache::get_instance()->set('access_token', $access_token->access_token, 3600);

    return self::getAccessToken();
  }
}