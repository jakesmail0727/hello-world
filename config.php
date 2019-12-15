<?php
if(!session_id())
    session_start();
require_once 'Facebook/autoload.php';

$app_id = '319572691789004';
$app_secret = '5a5e9f8dca390b0f5023b317398c83fc';
$permissions = ['email']; // Optional permissions
$callbackUrl = 'http://localhost/fb_auth/callback.php';

$fb = new Facebook\Facebook([
    'app_id' => $app_id, // Replace {app-id} with your app id
    'app_secret' => $app_id,
    'default_graph_version' => 'v3.2',
    ]);
  
  $helper = $fb->getRedirectLoginHelper();
  
  
  $loginUrl = $helper->getLoginUrl($callbackUrl, $permissions);
  
?>