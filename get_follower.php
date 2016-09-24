<?php 

    session_start();
    require "autoload.php";
    use Abraham\TwitterOAuth\TwitterOAuth;
    
    if(isset($_SESSION['access_token'])){
            $access_token = $_SESSION['access_token'];
            $connection = new TwitterOAuth($_SESSION['consumer_key'], $_SESSION['consumer_secret'], $access_token['oauth_token'], $access_token['oauth_token_secret']);
            $count = 5000;
            $cursor = -1;
            $follow_array;
            while($cursor != 0){
                
                
                $followers = $connection->get('followers/ids',array('count' => $count, 'screen_name' => 'narendramodi', 'cursor' => $cursor));
                $follow_array = json_encode($followers,true);
                $follow_array = array_merge($follow_array, $followers);
                $cursor = $followers->next_cursor;
            }
            

            echo "<pre>";
            print_r($follow_array);
            echo "</pre>";
    }else{

    }
?>