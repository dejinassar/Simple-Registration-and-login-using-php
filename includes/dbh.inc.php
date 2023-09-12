<?php
//db connection
    $conn = mysqli_connect('localhost', 'root', '', 'contact_form');

    if($conn){
        //die("Connection Failed: ". mysqli_connect_error());
        echo "connection success";
    }

?>