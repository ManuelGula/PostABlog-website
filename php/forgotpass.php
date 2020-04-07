<?php
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: blogsfeed.php");
        exit;
    }
    if(isset($_SESSION["isadmin"]) && $_SESSION["isadmin"] === true){
        header("location: blogsfeed.php");
        exit;
    }
    include_once "mailto.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Password Recovery</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/sign-in.css">
        <link rel="stylesheet" href="../css/highlight.css">
        <script type="text/javascript" src="../js/signin.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon_io/android-chrome-512x512.png">
    </head>
    <?php
        include_once "navbar.php";
    ?>
    <body>
        <h1>Forgot Password</h1>
        <div>
            <form name="forgotpass" method="POST" action="">
                <fieldset >
                <?php echo "<p style='text-align:center;color:Red;font-weight:bold'>".$email_err."</p>"; ?>
                        <p>
                            <label>Email:</label>
                            <br/>
                            <input id="email" type="email" name="useremail" placeholder="Enter your email">
                        </p>
                    <button type="submit">Submit</button>
                    <button type="reset">Reset</button>

                </fieldset>
            </form>
        </div>
    </body>
    <?php   include_once "footer.php"?>
</html>