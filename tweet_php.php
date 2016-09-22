<?php
    session_start();
    require 'autoload.php';
    use Abraham\TwitterOAuth\TwitterOAuth;
    if(isset($_GET['user_id'])){
        
        
        if(isset($_SESSION['access_token'])){
           
        $access_token = $_SESSION['access_token'];
        $connection = new TwitterOAuth($_SESSION['consumer_key'], $_SESSION['consumer_secret'], $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $user = $connection->get("account/verify_credentials");
        
        $count = 10;
        if($user->statuses_count < 10){
            $count = $user->statuses_count;
        }

        $tweets = $connection->get('statuses/user_timeline', ['count' => $count, 'user_id' => $_GET['user_id'] , 'exclude_replies' => true]);
        
        
        //print_r($tweets[0]);
        
                        for($i=0;$i<$count;$i++){ 
                        
                        echo "<div class='well item"; echo ($i == 0) ? ' active' : '';
                        echo "'>";
                        echo "<table class='table' style='border:0'>
                                    <tbody>
                                        <tr>
                                            <th rowspan='2' style='width:20%'>
                                                <img src=";echo ($tweets[$i]->retweeted == 1) ? $tweets[$i]->retweeted_status->user->profile_image_url : $tweets[$i]->user->profile_image_url; 
                                                echo " />";
                                    echo   "</th>
                                            <th>".$tweets[$i]->user->screen_name."</th>
                                        </tr>
                                        <tr>
                                            <th>".substr($tweets[$i]->created_at,4,7)."</th>
                                        </tr>
                                    </tbody>
                                </table>";
                                
                             echo "<h4>".$tweets[$i]->text."</h4>
                                <h4><span class='glyphicon glyphicon-heart'></span>&nbsp;".$tweets[$i]->favorite_count."&emsp;
                                <span class='glyphicon glyphicon-retweet'></span>&nbsp;".$tweets[$i]->retweet_count."</h4>
                                ";
                                
                                    if(isset($tweets[$i]->entities->media)){
                                
                                echo "<div id='image_url'".$i." class='collapse image_class'>
                                            <img src='".$tweets[$i]->entities->media[0]->media_url."' style='max-width: 100%; height: auto;' />
                                        </div>
                                         <button type='button' id='col_btn'".$i." class='btn btn-info image_btn' data-toggle='collapse' data-target='#image_url'".$i." style='float:right'><span class='glyphicon glyphicon-collapse-down'></span> Open</button>";
        
                                    }
                              echo " 
                                <br>
                                
                            </div>";

                         echo "<a class='left carousel-control' href='#myCarousel' role='button' data-slide='prev'>
                                <span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>
                                <span class='sr-only'>Previous</span>
                            </a>
                            <a class='right carousel-control' href='#myCarousel' role='button' data-slide='next'>
                                <span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>
                                <span class='sr-only'>Next</span>
                            </a>
                        ";    
                        }
                        
                
        
        
    }else{
        echo "jhkj";
    }
    }
    
        
?>