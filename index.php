<?php
    session_start();
    require 'autoload.php';
    use Abraham\TwitterOauth\TwitterOAuth;

    define('CONSUMER_KEY','apnVcXUcB7XwJCSDZwyj5LSTR');
    define('CONSUMER_SECRET','WOrDDgH5z1NpVY6RinOEU7ZjjYMq4eDlQi0qUIaivUZ7rF0sYE');
    define('OAUTH_CALLBACK','https://vishalphptweet.herokuapp.com/callback.php');

    if(!isset($_SESSION['access_token'])){
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
        $_SESSION['oauth_token'] = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
        $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
        echo $url;
    }else{
        $access_token = $_SESSION['access_token'];
        $connection = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $user = $connection->get("account/verify_credentials");
        echo $user->status->text;
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
                <h2>RtCamp Assignment:</h2>
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

