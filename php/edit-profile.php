<?php 

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/sign-up.css">
        <title>Edit Profile</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon_io/android-chrome-512x512.png">
    </head>
    <?php include_once "navbar.php" ?>
    <body>
        <h1>Edit Profile</h1>
        <div >
            <form name="editprofile" method="" action="" onsubmit="return validateform()">
                <fieldset >
                        <div>
                            <p>
                                <label>Firstname:</label>
                                <br/>
                                <input id="firstname" type="text" name="fname" value="56665" >
                            </p>
                            <p>
                                <label>Lastname:</label>
                                <br/>
                                <input id="lastname" type="text" name="lname" placeholder="Enter your lastname">
                            </p>
                        </div>
                        <p>
                            <label>Email:</label>
                            <br/>
                            <input id="email" type="email" name="email" placeholder="Enter your email">
                        </p>

                        <p> 
                            <label>Bio:</label>
                            <br/>
                            <textarea id="bio" rows="5" placeholder="Tell us something about yourself"></textarea>
                        </p>
                        <p>
                            <label>Change profile image</label>
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
                var fname=document.forms["editprofile"]["fname"].value;
                var lname=document.forms["editprofile"]["lname"].value;
                var username=document.forms["editprofile"]["username"].value;
                var email=document.forms["editprofile"]["email"].value;
                var bio=document.getElementById("bio").value;
                var image=document.forms["editblog"]["prof_image"].value;
                if (fname=="" || lname=="" || username=="" || email==""){
                    alert("all fields must be filled")
                    return false;
                }
                else if(fname=="" ){
                    alert("You must enter a first name!");
                    return false;
                }
                else if(lname=="" ){
                    alert("You must enter a  last name!");
                    return false;
                }
                else if(username==""){
                    alert("You must enter your username");
                    return false;
                }
                else if(email==""){
                    alert("You must enter an email");
                    return false;
                }
                else if(bio==""){
                    alert("You must enter an bio");
                    return false;
                }
                else if(image==""){
                    alert("you must upload an image");
                    return false;
                }
            }
        </script>
    </body>
    <footer >
        <p >
            <ul>
                <div class="navbar-header" >
                <li><a href="blogsfeed.html">Blogs</a></li>|
                <li><a href="savedposts.html">My Saved Blogs</a></li>|
                <li><a href="aboutus.html">About us</a></li>|
                <li><a href="adminlogin.html">Admin login</a></li>
                </div>
            </ul>
            &copy; COSC 360 Project 
        </p>
    </footer>
</html>