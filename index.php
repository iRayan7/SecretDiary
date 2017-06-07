<?php

    session_start();
    
    
    if(isset($_GET['logout'])){
        session_unset();
        setcookie("id","",time() -60*60*24*5+10);
        $_COOKIE['id'] = '';
        
     } else if(isset($_SESSION['id']) AND $_SESSION['id'] OR isset($_COOKIE['id']) AND $_COOKIE['id']){
        header("Location: /diary.php");
    }

    $error = '';
    if(isset($_POST['submit'])){
        
        include("con.php"); // connection to database
        
        if(!$_POST['email']){
            $error .= "An email is required<br>";
        }
        
        if(!$_POST['password']){
            $error .= "A password is required<br>";
        }
        
        if($error != ''){
            $error = "<p>there were error(s) in your form:</p>".$error;
        } else {
            
            if($_POST['signup'] == 1){
            
                $query = "SELECT `id` FROM `users` where email = '".mysqli_real_escape_string($link,$_POST['email'])."'";

                $result = mysqli_query($link,$query);
                if(mysqli_num_rows($result) >0){
                    $error = "email already used.";
                } else {
                    $query = "INSERT INTO `users` (`email`,`password`) VALUES ('".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['password'])."')";

                    if(!mysqli_query($link,$query)){
                        $error = "<p>couldn't sign you up, please try again later.</p>";
                    } else {
                        $query = "UPDATE users SET password = '".md5(md5(mysqli_real_escape_string($link,$_POST['password'])))."' WHERE id = '".mysqli_insert_id($link)."'";
                        mysqli_query($link, $query);

                        $_SESSION['id'] = mysqli_insert_id($link);

                        if(isset($_POST['stayloggedin'])){
                            setcookie('id', mysqli_insert_id($link), time() + 60*60*24*5);
                        }

                        header("Location: /diary.php");
                    }
                }
            } else {
                
                $query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link,$_POST['email'])."'";
                $result = mysqli_query($link,$query);
                $row = mysqli_fetch_array($result);
                
                if(isset($row['id'])){
                    $hashedpassword = md5(md5(mysqli_real_escape_string($link,$_POST['password'])));
                    if($hashedpassword == $row['password']){
                        $_SESSION['id'] = $row['id'];
                        
                        if(isset($_POST['stayloggedin'])){
                        setcookie('id', $row['id'], time() + 60*60*24*5);
                        }
                        
                        header("Location: /diary.php");
                    } else {
                        $error = "<p> Email or/and Password isn't correct</p>";
                    }
                    
                } else {
                    $error = "<p> Email or/and Password isn't correct</p>";
                }
            }
        }
    }
?>

  

    
<? include("header.php"); ?>
    <div class="background-image"></div>
    <div class="container" id="main">  
        
        <h1>Secret Diary</h1>
        <p><strong>Secure your thoughts permanently and securely!</strong></p>
        <div id="error" > <?php if($error != ''){ 
                                                echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                                                } ?></div>
        <form method="post" id="signupForm">
            <p>Interested? sign up now!</p>
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="your email">
            </div>
            <div class="form-group">    
                <input class="form-control" type="password" name="password" placeholder="your password">
            </div>   
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="1" name="stayloggedin"> Stay Logged In
                </label>
            </div>
            <input type="hidden" name="signup" value="1">
            <div class="form-group">
                <button class="btn btn-success" type="submit" name="submit" >Sign Up</button>
            </div>
            <p class="toggleClass"><a href="#">Login</a></p>
            
        </form>

        <form method="post" id="loginForm" >
            <p>Login using your Email and Password.</p>
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="your email">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="your password">
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="1" name="stayloggedin"> Stay Logged in
                </label>
            </div>
            <input type="hidden" name="signup" value="0">
            <div class="form-group">
                <button class="btn btn-success" type="submit" name="submit" >Login</button>
            </div>
            <p class="toggleClass"><a href="#">Sign Up</a></p>
        </form>
        
    </div>
    
      
      
      <?php include("footer.php"); ?>
    
