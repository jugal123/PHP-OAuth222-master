<?php
require('path/to/client.php');
require('path/to/GrantType/IGrantType.php');
require('path/to/GrantType/AuthorizationCode.php');

$clientId = 'yourClientId';
$clientSecret = 'yourClientSecret';
$client = new OAuth2\Client($clientId, $clientSecret);

$redirectUrl    = 'http://www.myapp.com/oauth_callback';
$authorizeUrl   = 'https://alchemy1.nationbuilder.com/oauth/authorize';
$authUrl = $client->getAuthenticationUrl($authorizeUrl, $redirectUrl);
echo $authUrl;

$code = '123456abcdef';
  
// generate a token response
$accessTokenUrl = 'https://alchemy1.nationbuilder.com/oauth/token';
$params = array('code' => $code, 'redirect_uri' => $redirectUrl);
$response = $client->getAccessToken($accessTokenUrl, 'authorization_code', $params);
// set the client token
$token = $response['result']['access_token'];
$client->setAccessToken($token);

$baseApiUrl = 'https://alchemy1.nationbuilder.com';
$client->setAccessToken($token);
$response = $client->fetch($baseApiUrl . '/api/v1/people');
print_r($response);
?>


