<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$firstname= $lastname= $username= $email = $password = $confirm_password= $bio= $image =  "";
$firstname_err= $lastname_err= $username_err =$email_err = $password_err = $confirm_password_err =$bio_err= $image_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    //validate email
    if(empty(trim($_POST["email"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = :email";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["retype-password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["retype-password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: signin.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Sign Up</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/sign-up.css"> 
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
                <li class="nav-item"><a class="nav-link" href="signin.php">Sign in</a></li>
              </ul>
            </div>
        </nav>
    </header>
    <body>
        <h1>Sign Up</h1>
        <div >
            <form name="signup" method="" action="" onsubmit="return validateform()">
                <fieldset >
                        <div>
                            <p>
                                <label>Firstname:</label>
                                <br/>
                                <input id="firstname" type="text" name="firstname" placeholder="Enter your firstname">
                            </p>
                            <p>
                                <label>Lastname:</label>
                                <br/>
                                <input id="lastname" type="text" name="lastname" placeholder="Enter your lastname">
                            </p>
                        </div>
                        <p>
                            <label>Username:</label>
                            <br/>
                            <input id="username" type="text" name="username" placeholder="Enter your username">
                        </p>
                        <p>
                            <label>Email:</label>
                            <br/>
                            <input id="email"  type="email" name="email" placeholder="Enter your email">
                        </p>
                        <div>
                            <p>
                                <label>Password:</label>
                                <br/>
                                <input id="password" type="password" name="password" placeholder="Enter your password">
                            </p>
                            <p>
                                <label>Retype Password:</label>
                                <br/>
                                <input id="retype-password" type="password" name="re-password" placeholder="Retype your password">
                            </p>
                        </div>
                        <div>
                            <p> 
                                <label>Bio:</label>
                                <br/>
                                <textarea id="bio" name="bio" rows="3" placeholder="Tell us something about yourself"></textarea>
                            </p>
                        </div>
                        <p>
                            <label>Add profile image</label>
                            <br/>
                            <input id="prof_image" name="prof_image" type="file" accept="image/*">
                        </p>
                    <button type="submit">Submit</button>
                    <button type="reset">Reset</button>

                </fieldset>
            </form>
        </div>
        <script>
            function validateform(){
                var fname=document.forms["signup"]["firstname"].value;
                var lname=document.forms["signup"]["lastname"].value;
                var username=document.forms["signup"]["username"].value;
                var email=document.forms["signup"]["email"].value;
                var bio=document.getElementById("bio").value;
                var pass=document.forms["signup"]["password"].value;
                var repass=document.forms["signup"]["retype-password"].value;
                var image=document.forms["signup"]["prof_image"].value;

                if(fname==""||fname==null){
                    alert("You must enter a first name!");
                    return false;
                }
                if(lname==""|| lname==null){
                    alert("You must enter a  last name!");
                    return false;
                }
                if(username==""|| username==null){
                    alert("You must enter your username");
                    return false;
                }
                if(email==""|| email==null){
                    alert("You must enter an email");
                    return false;
                }
                if(pass==""|| pass==null){
                    alert("You must enter an password");
                    return false;
                }
                if(repass==""|| repass==null){
                    alert("retype password");
                    return false;
                }
                if(bio==""||bio==null){
                    alert("You must enter an bio");
                    return false;
                }
                if(image==""|| image==null){
                    alert("you must upload an image");
                    return false;
                }
                if(pass!==repass){
                    alert("passwords must match")
                    return false;
                }
            }
        </script>
    </body>
    <footer>
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