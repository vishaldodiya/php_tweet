<?php
    error_reporting(E_ALL & ~E_NOTICE);
    session_start();
    require 'autoload.php';
    use Abraham\TwitterOAuth\TwitterOAuth;

    if(isset($_REQUEST['oauth_verifier'], $_REQUEST['oauth_token']) && $_REQUEST['oauth_token'] == $_SESSION['oauth_token']){
        $connection = new TwitterOAuth($_SESSION['consumer_key'], $_SESSION['consumer_secret'], $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
        $access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
        $_SESSION['access_token'] = $access_token;
       // $user = $connection->get("account/verify_credentials");
        //echo "HI!!,". $user->screen_name;
        //echo "<br>";
        //$tweets = $connection->get('statuses/user_timeline', ['count' => 10, 'exclude_replies' => true]);
        //print_r($tweets);
        header("location: http://127.0.0.1/php_tweet/home.php");
        //echo "verified";
    }else{
        echo "not verified";
    }
?>