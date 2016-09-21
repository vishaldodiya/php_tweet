<?php
    session_start();
    require 'autoload.php';
    use Abraham\TwitterOAuth\TwitterOAuth;

    if(isset($_SESSION['access_token'])){
        $access_token = $_SESSION['access_token'];
        $connection = new TwitterOAuth($_SESSION['consumer_key'], $_SESSION['consumer_secret'], $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $user = $connection->get("account/verify_credentials");
        
        $count = 10;
        if($user->statuses_count < 10){
            $count = $user->statuses_count;
        }

        $tweets = $connection->get('statuses/user_timeline', ['count' => $count, 'screen_name' => 'Ahmedabadblog1' , 'exclude_replies' => true]);

    
        $profile_image_url = $user->profile_image_url;
        $profile_banner_url = $user->profile_banner_url;
        $profile_name = $user->name;
        $profile_screen_name = $user->screen_name;
        $profile_followers_count = $user->followers_count;
        $profile_friends_count = $user->friends_count;
        $profile_statuses_count = $user->statuses_count;
        
        $cursor = -1;

        while($cursor != 0){
            $ids = $connection->get("followers/ids", array("screen_name" => $profile_screen_name, "cursor" => $cursor));
            $cursor = $ids->next_cursor;
        }
        
        /*
        $result = $connection->get("users/lookup", array("user_id" => "426219612"));
        echo "<pre>";
        print_r($result);
        echo "</pre>";
        */
        /*
        for($i=0;$i<10;$i++){
            $rand_no = rand(1,40);
            $rand_id = $ids->ids[$rand_no];
            $result = $connection->get("users/lookup", array("user_id" => $rand_id));
            echo "<pre>";
            print_r($result);
            echo "</pre>";
           
        }
        
       /*
       echo "<pre>";
            print_r($tweets);
       echo "</pre>";
       */
    }
        
?>

<html>
    <head>

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jcarousel/0.3.4/jquery.jcarousel.min.js"></script>
        <script type="text/javascript" src="jcarousel.responsive.js"></script>
        <link rel="stylesheet" type="text/css" href="jcarousel.responsive.css">

        <script>
            $(document).ready(function(){
                $("#myCarousel").carousel({interval: 2000});

                $(".image_class").on("hide.bs.collapse", function(){
                    $(".image_btn").html('<span class="glyphicon glyphicon-collapse-down"></span> Open');
                });
                $(".image_class").on("show.bs.collapse", function(){
                    $(".image_btn").html('<span class="glyphicon glyphicon-collapse-up"></span> Close');
                });

               $(".image_clk").click(function(){
                   var u_id = $(this).data('id');
                   $.ajax({
                        url:"tweet_php.php",
                        method:"GET",
                        data:{user_id:u_id},
                        success:function(html){
                            //document.write(html.id);
                            
                            $("#tweet").html(
                                html
                            );
                            
                        }
                    });
               });

                
            });
        </script>

        <style>
            
        </style>        
    </head>

    <body>
        <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
            <a class="navbar-brand" href="#">WebSiteName</a>
            </div>
            <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Page 1</a></li>
            <li><a href="#">Page 2</a></li> 
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
        </div>
        </nav>
        <div class="container">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-3">
                        <img src="<?php echo $profile_banner_url; ?>" class="img-rounded" width="100%" height="100">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?php echo $profile_image_url; ?>" class="img-rounded"  width="50" height="50">
                            </div>
                            <div class="col-sm-9">
                                <h3><?php echo $profile_name; ?></h3>
                            </div>
                        </div>
                        <div class="row">
                            <h4>Tweets<span class="badge"><?php echo $profile_statuses_count; ?></span></h4>
                            <h4>Followers<span class="badge"><?php echo $profile_followers_count; ?></span></h4>
                            <h4>Friends<span class="badge"><?php echo $profile_friends_count; ?></span></h4>
                        </div>
                    </div>
                    <div class="col-sm-6" id="tweet">
                       
                    </div>
                </div>

                <div class="row">
                    <div class="jcarousel-wrapper">
                        <div class="jcarousel">
                            <ul>
                  <?php  
                    for($i=0;$i<10;$i++){
                        $rand_no = rand(1,40);

                        $rand_id = $ids->ids[$rand_no];
                        $result = $connection->get("users/lookup", array("user_id" => $rand_id));
                    ?>                            
                                <li id="image_clk_<?php echo $i; ?>" class="image_clk" data-id="<?php echo $rand_id; ?>">
                                <div class="well" style="max-width:95%;height:230px;">
                                    <img src="<?php if(isset($result[0]->profile_banner_url)){
                                                        echo $result[0]->profile_banner_url;
                                                         
                                                    }else{
                                                      echo "default.JPG";  
                                                    }                                                          
                                                        
                                                ?>" class="img-rounded"  style="width:100%;height:100">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img src="<?php echo $result[0]->profile_image_url; ?>" class="img-rounded"  width="50" height="50">
                                        </div>
                                        <div class="col-sm-9">
                                            <h3><?php echo $result[0]->screen_name; ?></h3>
                                        </div>
                                    </div>
                                </div>
                                </li>
                        <?php
                            }
                        ?>
                            </ul>
                        </div>

                        <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
                        <a href="#" class="jcarousel-control-next">&rsaquo;</a>

                        <p class="jcarousel-pagination"></p>
                    </div>

                    
                    
                    
                </div>
            </div>
        </div>
        
    </body>
</html>




