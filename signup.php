<?php
    require 'header.php';
?>

<main>
        <h2 id="head">Create an account</h2>
    <?php
            //If there is problem while fill up sign UP form
            if(isset($_GET['error'])){
                if($_GET['error'] == 'emptyfields'){
                    echo "<p class=signupError>*Fill In All The Fields</p>";
                }
                elseif($_GET['error'] == 'invalidemailuid'){
                    echo "<p class=signupError>*Invalid username and Email</p>";
                }
                elseif($_GET['error'] == 'invalidemail'){
                    echo "<p class=signupError>*Invalid Email</p>";
                }
                elseif($_GET['error'] == 'invaliduid'){
                    echo "<p class=signupError>*Invalid Username</p>";
                }
                elseif($_GET['error'] == 'passwordcheck'){
                    echo "<p class=signupError>*Your Password Did Not Match</p>";
                }
                elseif($_GET['error'] == 'userTaken'){
                    echo "<p class=sig=nupError>*User name already taken</p>";
                }

            } /*NO error = success */
            elseif(isset($_GET["signup"]) == "success"){
                echo "<p class=signupsuccess><b>Sign Up Successful </b></p>";
            } 
       ?>


    <div id="wrapper2">
        <div id="signup">
        <form action="includes/signup.inc.php" method="post">
            <div>
            <input type="text" name="uid" placeholder="Username" class="text-input"> <br> <br>
            </div>
            <div>
            <input type="text" name="mail" placeholder="E-Mail" class="text-input"> <br> <br>
            </div>
            <div>
            <input type="password" name="pwd" placeholder="Password" class="text-input"> <br> <br>
            </div>
            <div>
            <input type="password" name="pwd-repeat" placeholder="Confirm Password" class="text-input"> <br> <br>
            </div>
            <div>
            <button type="submit" name="signup-submit" class="primary-btn">Sign Up</button>         
            </div>
        </form> 
        </div>
    </div>
</main>

<?php 
    require 'footer.php';
?>