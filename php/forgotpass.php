<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Password Recovery</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/sign-in.css">
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
            <form name="forgotpass" method="POST" action="mailto.php" onsubmit="return validateform()">
                <fieldset >
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
        <script>
            function validateform(){
                
                var email=document.forms["forgotpass"]["email"].value;
                
                if(email=="" || email==null){
                    alert("enter your email");
                    return false;
                }
            }
        </script>
    </body>
    <?php   include_once "footer.php"?>
</html>