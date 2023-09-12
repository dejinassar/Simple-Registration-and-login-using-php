<?php

if(isset($_POST['signin'])){

    require 'dbh.inc.php';
    
    $mailuid = $_POST["mailuid"];
    $password = $_POST["pwd"];

    if(empty($mailuid) || empty($password)){
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    else{
        $sql = "SELECT * FROM lists WHERE username=? OR email=?;";
        $stmt = mysqli_stmt_init($conn); //it checks the DB connection with prepared statements
        if(!mysqli_stmt_prepare($stmt, $sql)){ //if DB connection with prepared statements failed
            header("Location: ../index.php?error=sqlerror");
            exit();
        } 
        else{
            mysqli_stmt_bind_param($stmt, "ss", $mailuid ,$mailuid ); //take the username from from users
            mysqli_stmt_execute($stmt); //here we execute the stmt given by users
            $result = mysqli_stmt_get_result($stmt); //all the results we got from the DB are stored in $result
            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($password, $row['password']); //it checks the password user put in for log in with the password -
                                                                            //stored in the DB
                if($pwdCheck == false){
                    header("Location: ../index.php?error=wrongPwd");
                    exit();
                }
                elseif($pwdCheck == true){
                    session_start();
                    $_SESSION['userID'] = $row['id'];
                    $_SESSION['userUid'] = $row['username'];
                    header("Location: ../dashboard.php");
                    exit();
                }
                else{
                    header("Location: ../index.php?error=wrongPwd");
                    exit();
                }
            } 
            else{
                header("Location: ../index.php?error=noUser");
                exit();
            }   

            
        }
    }

}else{
    header("Location: ../index.php"); 
    exit();
}
?>
