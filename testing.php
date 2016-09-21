 <div class="carousel slide" id="myCarousel">
                        <div class="carousel-inner" role="listbox">
                        <?php  
                        
                        for($i=0;$i<$count;$i++){ 
                        ?>
                            <div class="well item <?php echo ($i == 0) ? "active" : ""; ?>">
                                <table class="table" style="border:0">
                                    <tbody>
                                        <tr>
                                            <th rowspan="2" style="width:20%">
                                                <img src="<?php 
                                                if($tweets[$i]->retweeted == 1)
                                                    echo $tweets[$i]->retweeted_status->user->profile_image_url; 
                                                else
                                                    echo $tweets[$i]->user->profile_image_url;
                                                ?>" />
                                            </th>
                                            <th><?php echo $tweets[$i]->user->screen_name; ?></th>
                                        </tr>
                                        <tr>
                                            <th><?php echo substr($tweets[$i]->created_at,4,7); ?></th>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                <h4><?php echo $tweets[$i]->text; ?></h4>
                                <h4><span class="glyphicon glyphicon-heart"></span>&nbsp;<?php echo $tweets[$i]->favorite_count; ?>&emsp;
                                <span class="glyphicon glyphicon-retweet"></span>&nbsp;<?php echo $tweets[$i]->retweet_count; ?></h4>
                                
                                <?php 
                                    if(isset($tweets[$i]->entities->media)){
                                ?>
                                        <div id="image_url<?php echo $i; ?>" class="collapse image_class">
                                            <img src="<?php echo $tweets[$i]->entities->media[0]->media_url; ?>" style='max-width: 100%; height: auto;' />
                                        </div>
                                         <button type="button" id="col_btn<?php echo $i; ?>" class="btn btn-info image_btn" data-toggle="collapse" data-target="#image_url<?php echo $i; ?>" style="float:right"><span class="glyphicon glyphicon-collapse-down"></span> Open</button>
                                
                                       
                                <?php        
                                    }
                                       
                                ?> 
                                
                                <br>
                                
                            </div>
                            
                        <?php } ?>
                            
                        </div>
                        </div>
                        