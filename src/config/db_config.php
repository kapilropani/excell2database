<?php

    $link = mysqli_connect("localhost", "root", "", "ak_excel");

    if($link){
        echo 'DB successfully connected';
    }
    else{
        echo 'Problem in connecting to the DB';
    }
?>