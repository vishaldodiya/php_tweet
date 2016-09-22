<?php

    require 'autoload.php';
    use Abraham\TwitterOAuth\TwitterOAuth;
    session_start();

        $count = 10;
        echo $_GET['u_id'];
        if(isset($_SESSION['access_token'])){

                $access_token = $_SESSION['access_token'];
                $connection = new TwitterOAuth($_SESSION['consumer_key'], $_SESSION['consumer_secret'], $access_token['oauth_token'], $access_token['oauth_token_secret']);
                $user = $connection->get("account/verify_credentials");

                if(isset($_GET['u_id'])){
                     $tweets = $connection->get('statuses/user_timeline', ['count' => $count , 'user_id' => $_GET['u_id'], 'exclude_replies' => true]);

                }else{
                    $tweets = $connection->get('statuses/user_timeline', ['count' => $count, 'exclude_replies' => true]);
                }

                require('fpdf.php');
                    $pdf = new FPDF('P','mm','A4');
                    $pdf->AddPage();
                    $pdf->SetFont('Arial','B',16);
                    $pdf->SetX(40);
                    $pdf->SetY(0);
                    $pdf->Cell(0,80, $user->name ."'s latest 10 tweets" );
                    $pdf->SetFont('Times','',13);

                    $y = 25;

                    for($i=0;$i<10;$i++){
                        $pdf->SetY($y);
                        $pdf->Cell(0,80, $tweets[$i]-> text );
                        $y = $y + 20;
                    }

                    $pdf->Output(); 
        }
       
?>