<?php
session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: blogsfeed.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>CookABlog - Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/landing-page.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon_io/android-chrome-512x512.png">
    </head>
    <?php
        include_once "navbar.php";
    ?>
    <body<>
        <div id="intro">
            <h1>
                Welcome To CookABlog
            </h1>
            <div>
                As the name indicates, come up with something for your blog.Our rules:
                <ol>
                    <li>Keep it safe and appropriate</li>
                    <li>Got nothing to post,just browse through the site</li>
                    <li>Have fun</li>
                </ol>
            </div>
        </div>
        <table>
                <tr>
                    <td><a  href="signin.php" style="margin-left: 30%; padding-left: 1em;padding-right: 1em;">Sign in</a></td>
                    <td><a href="signup.php" style="padding-left: 0;margin-right: 15%;">Sign-up</a></td>
                </tr>
                <tr>
                    <td><a  href="blogsfeed.php" style="margin-left: 30%;">Browse Blogs</a></td>
                    <td><a href="aboutus.php" style="padding-left: 0;margin-right: 15%;">About Us</a></td>
                </tr>
            </tbody>
        </table>
    </body>
    <?php  include_once "footer.php" ?>
</html>