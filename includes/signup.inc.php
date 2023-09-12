<?php
if(isset($_POST['signup-submit'])){
    require 'dbh.inc.php';

    $username = $_POST['uid'];
    $Email = $_POST['mail'];
    $Password = $_POST['pwd'];
    $PasswordRepeat = $_POST['pwd-repeat'];

    // Error handling
    if(empty($username) || empty($Email) || empty($Password) || empty($PasswordRepeat)){
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$Email);
        exit();
    }
    // If there is an email error & a username error
    elseif(!filter_var($Email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../signup.php?error=invalidemailuid");
        exit();
    }
    // If there is an email error
    elseif(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../signup.php?error=invalidemail&uid=".$username);
        exit();
    }
    // If there is a username error
    elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../signup.php?error=invaliduid&mail=".$Email);
        exit();
    }
    // If two passwords didn't match
    elseif($Password !== $PasswordRepeat){
        header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$Email);
        exit();
    }

    // If a user tries to SignUP enter a username which is already in the database, then it will show an error
    else{
        $sql = "SELECT username FROM lists WHERE username=?";
        $stmt = mysqli_stmt_init($conn); // Check the DB connection with prepared statements

        if(!mysqli_stmt_prepare($stmt, $sql)){ // If DB connection with prepared statements failed
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $username); // Take the username from users
            mysqli_stmt_execute($stmt); // Execute the statement and see if there is any user with the same username in the DB
            mysqli_stmt_store_result($stmt); // Store the result we got from the DB in the "$stmt" variable
            $resultCheck = mysqli_stmt_num_rows($stmt); // "$resultCheck" variable stores the number of results (rows) returned from the DB
            if($resultCheck > 0){
                header("Location: ../signup.php?error=userTaken&mail=".$Email);
                exit();
            }
            else{
                // Use SHA-256 hashing for the password
                $hashedPwd = hash('sha256', $Password);

                $sql = "INSERT INTO lists(username, email, password) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn); // Check the DB connection with prepared statements

                if(!mysqli_stmt_prepare($stmt, $sql)){ // If DB connection with prepared statements failed
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($stmt, "sss", $username, $Email, $hashedPwd); // Take the username, email & hashed password from users
                    mysqli_stmt_execute($stmt); // Execute the statement and insert into the DB
                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("Location: ../signup.php"); // If a user gains access without clicking the "signUP" button
    exit();
}
?>