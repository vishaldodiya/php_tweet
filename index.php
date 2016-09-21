<?php
    session_start();
    error_reporting(E_ALL & ~E_NOTICE);
    require 'autoload.php';
    use Abraham\TwitterOAuth\TwitterOAuth;

    $_SESSION['consumer_key'] = "apnVcXUcB7XwJCSDZwyj5LSTR";
    $_SESSION['consumer_secret'] = "WOrDDgH5z1NpVY6RinOEU7ZjjYMq4eDlQi0qUIaivUZ7rF0sYE";

    if(!isset($_SESSION['access_token'])){
        $connection = new TwitterOAuth($_SESSION['consumer_key'], $_SESSION['consumer_secret']);
        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => 'http://127.0.0.1/php_tweet/callback.php'));
        $_SESSION['oauth_token'] = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
        $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
        echo $url;
    }else{
        $access_token = $_SESSION['access_token'];
        $connection = new TwitterOAuth($_SESSION['consumer_key'], $_SESSION['consumer_secret'], $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $user = $connection->get("account/verify_credentials");
        echo "<pre>";
        print_r($user->status);
        echo "</pre>";
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="jumbotron">
                <h1>Vishal Dodiya</h1>
                <br>
                <h2>RtCamp Asssi:</h2>
                <br>
            </div>
            <br>
            <div class="jumbotron">
                <a href='<?php echo $url; ?>'><button class="btn btn-primary">Twiter Login</button></a>
            </div>
            <br>
            <div class="jumbotron">

            </div>
        </div>

    </body>            
</html>

