<?php 
    session_start();
    require_once __DIR__ . '/Facebook/autoload.php';
    $app_id = '319572691789004';
    $app_secret = '5a5e9f8dca390b0f5023b317398c83fc';
    $callbackUrl = 'http://localhost/fb_auth/';

    $fb = new Facebook\Facebook([
        'app_id' => $app_id, // Replace {app-id} with your app id
        'app_secret' => $app_id,
        'default_graph_version' => 'v3.2',
    ]);
    $permissions = []; // Optional permissions
    $helper = $fb->getRedirectLoginHelper();
    $accessToken = $helper->getAccessToken();
    $url = "https://graph.facebook.com/v3.2/me?fields=id,name&access_token={$accessToken}";
    $headers = array("Content-type: application/json");
        
    if(isset($accessToken)){
        auth_facebook($url,$headers,$accessToken);
    }else{
        $loginUrl = $helper->getLoginUrl($callbackUrl,$permissions);
        echo '<a href="'. $loginUrl .'">Post to wall</a></br>';
        echo '<a href="'. $loginUrl .'">Post to group</a></br>';
        echo '<a href="'. $loginUrl .'">Post to page</a>';
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function auth_facebook($url,$headers,$accessToken){
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $st = curl_exec($ch);
        $result = json_decode($st,TRUE);
        var_dump($result);
    }
?>
