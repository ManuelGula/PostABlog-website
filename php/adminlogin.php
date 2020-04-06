<?php

session_start();
 
// Check if a user is already logged in, if yes then log them out
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $_SESSION = array();
    session_destroy();
}
if(isset($_SESSION["isadmin"]) && $_SESSION["isadmin"] === true){
    header("location: blogsfeed.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
$acct_err="";
 
// Processing form data when form is submitted
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
        $sql = "SELECT adminid, username, password FROM admin WHERE username = :username";
        
        if($stmt = $link->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 0){
                    $acct_err="<p style='text-align:center;color:Red;font-weight:bold'>Invalid login credentials<p>";
                }
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["adminid"];
                        $username = $row["username"];
                        $adminpassword = $row["password"];
                        if($adminpassword===$password){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["isadmin"] = true;
                            $_SESSION["adminid"] = $id;
                            $_SESSION["admin"] = $username;                            
                            
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
                    // echo $username_err;
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($link);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Admin Sign In</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/sign-in.css">
        <link rel="stylesheet" href="../css/highlight.css">
        <script type="text/javascript" src="../js/admin.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon_io/android-chrome-512x512.png">
    </head>
    <?php  require_once "navbar.php" ?>
    <body>
        <h1>Admin Sign In</h1>
        <div>
            <form id="adminlogin" name="adminlogin" method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>"  >
                <fieldset  >
                        <p>
                            <label>Username:</label>
                            <br/>
                            <input id="username" type="text" name="username" placeholder="Enter your username">
                        </p>
                        <p>
                            <label>Password:</label>
                            <br/>
                            <input id="password" type="password" name="password" placeholder="Enter your password">
                        </p>
                    <button type="submit">Submit</button>
                    <button type="reset">Reset</button>

                </fieldset>
            </form>
        </div>
    </body>
    <?php  require_once "footer.php" ?>
</html>