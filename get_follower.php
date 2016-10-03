<?php 

    session_start();
    require "autoload.php";
    use Abraham\TwitterOAuth\TwitterOAuth;
    
    ignore_user_abort(true);
    set_time_limit(3600);

    if(isset($_SESSION['access_token'])){
            $access_token = $_SESSION['access_token'];
            $connection = new TwitterOAuth($_SESSION['consumer_key'], $_SESSION['consumer_secret'], $access_token['oauth_token'], $access_token['oauth_token_secret']);
            $count = 5000;
            $cursor = -1;
            $i = 0;
            $follow_array = array();
            while($cursor != 0){
                $i++;
                echo "=============================$i===================================";
                $followers = $connection->get('followers/ids',array('count' => $count, 'screen_name' => 'narendramodi', 'cursor' => $cursor));
                echo "<pre>";
            print_r($followers);
            echo "</pre>";
                //sleep();
                echo "======================================================";
                //if($folloers->
                //$follow_array = json_encode($followers,true);
                //$follow_array = array_merge($follow_array, $follow_array);
                

                if(isset($followers->errors)){
                    echo "===========================================sleep=======================================";
                    sleep(600);
                }else{
                    $cursor = $followers->next_cursor;
                }

                
            }



            

            
    }else{

    }
?>
