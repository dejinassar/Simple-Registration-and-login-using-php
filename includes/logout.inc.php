<?php
    session_start();
    session_unset(); //saved ID's and PWD's are deleted from the session variable
    session_destroy();
    header("Location: ../index.php");
?>