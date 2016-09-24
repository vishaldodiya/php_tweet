<?php 

    session_start();
    require "autoload.php";
    use Abraham\TwitterOAuth\TwitterOAuth

    if(isset($_SESSION['access_token'])){
        $access_token = $_SESSION['access_token'];
        $connection = new TwitterOAuth($_SESSION['consumer_key'], $_SESSION['consumer_secret'], $access_token['oauth_token'], $access_token['oauth_token_secret']);

        $count = 5000;

        $followers = $connection->get('followers/ids', ['count' => $count, 'screen_name' => 'narendramodi']);

        echo "<pre>";
        print_r($followers);
        echo "</pre>";  
    }
?>