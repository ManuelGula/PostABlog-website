<?php
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: blogsfeed.php");
        exit;
    }
    require_once "config.php";

    $username = $password = "";
    $username_err = $password_err = "";
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
 
        // Check if username is empty
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter username.";
        } else{
            $username = trim($_POST["username"]);
        }
        
        // Check if password is empty
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        // Validate credentials
        if(empty($username_err) && empty($password_err)){
            // Prepare a select statement
            $sql = "SELECT userid, username, password FROM users WHERE username = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                // Set parameters
                $param_username = $username;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Store result
                    mysqli_stmt_store_result($stmt);
                    
                    // Check if username exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1){                    
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($password, $hashed_password)){
                                // Password is correct, so start a new session
                                session_start();
                                
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;                            
                                
                                // Redirect user to welcome page
                                header("location: blogsfeed.php");
                            } else{
                                // Display an error message if password is not valid
                                $password_err = "The password you entered was not valid.";
                            }
                        }
                    } else{
                        // Display an error message if username doesn't exist
                        $username_err = "No account found with that username.";
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        
        // Close connection
        mysqli_close($link);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Sign In</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/sign-in.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon_io/android-chrome-512x512.png">
        
    </head>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light ">
            <a class="navbar-brand" href="landing-page.html">CookABlog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="blogsfeed.html">Blogs</a></li>
                <li class="nav-item"><a class="nav-link" href="savedposts.html">My Saved Blogs</a></li>
                <li class="nav-item"><a class="nav-link" href="aboutus.html">About us</a></li>
                <form class="form-inline" method="" action="">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search for a title" aria-label="Search for a title">
                    <button class="btn btn-danger navbar-btn" type="submit">Search</button>
                </form>
                <li class="nav-item"><a class="nav-link" href="signup.php">Sign up</a></li>
              </ul>
            </div>
        </nav>
    </header>
    <body>
        <h1>Sign In</h1>
        <div>
            <form id="signin" name="signin" method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" 
            onsubmit="return validateform()">
                <fieldset >
                        <p>
                            <label>Username:</label>
                            <br/>
                            <input id="username"  type="text" name="username" placeholder="Enter your username">
                        </p>
                        <p>
                            <label>Password:</label>
                            <br/>
                            <input id="password"  type="password" name="password" placeholder="Enter your password">
                        </p>
                        <p>
                            <a href="forgotpassword.html">Forgot password</a>
                        </p>
                    <button type="submit">Submit</button>
                    <button type="reset">Reset</button>

                </fieldset>
            </form>
        </div>
        <script>
            function validateform(){
                var username=document.forms["signin"]["username"].value;
                var password=document.forms["signin"]["password"].value;
                if(username=="" && password=="" ){
                    alert("enter username and password");
                    return false;
                }
                else if(username==""){
                    alert("enter username to sign in");
                    return false;
                }
                else if(password==""){
                    alert("enter password");
                    return false;
                }
            }
        </script>
    </body>
    <footer  >
        <p>
            <ul>
                <div class="navbar-header">
                </div>
                <li><a href="blogsfeed.html">Blogs</a></li>|
                <li><a href="savedposts.html">My Saved Blogs</a></li>|
                <li><a href="aboutus.html">About us</a></li>|
                <li><a href="adminlogin.html">Admin login</a></li>
            </ul>
            &copy; COSC 360 Project 
        </p>
    </footer>
</html>