<?php
require 'header.php';
?>
<body>
    <header>
    <div id="wrapper">
        <div id="left">
            <div id="signin">
                <div class="logo">
                    <img src="img/img1.png" alt="Pluralsight">
                </div>
                
                <?php
                if(isset($_SESSION['userID'])){
                    header("Location: dashboard.php"); // Redirect logged-in users to the dashboard
                    exit();
                }
                echo '<form action="includes/signin.inc.php" method="post">
                    <div>
                        <label>Email or Username</label>
                        <input type="text" name="mailuid" class="text-input">
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="password" name="pwd" class="text-input">
                    </div>
                    <button type="submit" name="signin" class="primary-btn">Sign In</button>
                </form>

                <div class="links">
                    <a href="#">Forgot Password</a>
                </div>
                <div class="or">
                    <hr class="bar">
                        <span>OR</span>
                    <hr class="bar">
                </div>
                <a href="signup.php" target="_blank" class="secondary-btn">Create an account</a>
            </div>';
                ?>
        </div>
        <div id="right">
            <div id="showcase">
                <div class="showcase-content">
                    <h1 class="showcase-text">Let's Create The Future
                        <strong>Together</strong>
                    </h1>
                    <a href="#" class="secondary-btn">Start a free 10-day trial</a>
                </div>
            </div>
        </div>
    </div>
    </header>

<?php 
require 'footer.php';
?>
