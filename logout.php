<?php
	session_start();
    session_destroy();
    
    header("Location: https://vishalphptweet.herokuapp.com/");
?>
