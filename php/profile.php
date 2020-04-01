<?php
    require_once "config.php";
    session_start();
    if(!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"] === true){
        header("location: signin.php");
        exit;
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/profile.css">
        <title>My Profile</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon_io/android-chrome-512x512.png">
    </head>
    <?php
        include_once "navbar.php";
        ?>
    <body>
        <div id="info" >
            <img  src="../images/welcome_image.jpg" alt="" class="img-rounded" >
            <p id="name" >Emmanuel Werimegbe</p>
            <div id="sub_info" >
                    <label for="email">Email:</label>
                    <p id="email">manny@mail.com</p>
            </div>
        </div>
        <div id="bio_content">
            <label >Biography</label>
            <p id="bio">
                The MyBlogPost website will allow registered users to create their own blog and unregistered users to view blog postings. Our goal is to produce a similar type of service that allows users to login using their username and password or register by providing their name, email address and image. Registered users will be able to post blogs and make
            </p>
        </div>
        <h1 >My Blogs</h1>
        <div class="blog_container" >
            <button id="remove_btn" > Delete </button>
            <a id="bloglink" href="#" >
                <div class="mysavedblogs" >
                    <div class="blog">
                        <label class= "title"> Some random text</label>
                        <p id="description">
                            Performed suspicion in certainty so frankness by attention pretended. 
                            Newspaper or in tolerably education enjoyment. Extremity excellent certainty discourse sincerity no he so resembled. 
                            Joy house worse arise total boy.
                        </p>
                        <p class="author&date">
                                Emmanuel Werimegbe on February 17,2020.
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="blog_container">
            <button id="remove_btn"> Delete </button>
            <a id="bloglink" href="#">
                <div class="mysavedblogs">
                    <div class="blog">
                        <label class= "title"> Some random text</label>
                        <p id="description">
                            Performed suspicion in certainty so frankness by attention pretended. 
                            Newspaper or in tolerably education enjoyment. Extremity excellent certainty discourse sincerity no he so resembled. 
                            Joy house worse arise total boy.
                        </p>
                        <p class="author&date">
                                Emmanuel Werimegbe on February 17,2020.
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="blog_container">
            <button id="remove_btn"> Delete </button>
            <a id="bloglink" href="#">
                <div class="mysavedblogs">
                    <div class="blog">
                        <label class= "title"> Some random text</label>
                        <p id="description">
                            Performed suspicion in certainty so frankness by attention pretended. 
                            Newspaper or in tolerably education enjoyment. Extremity excellent certainty discourse sincerity no he so resembled. 
                            Joy house worse arise total boy.
                        </p>
                        <p class="author&date">
                                Emmanuel Werimegbe on February 17,2020.
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="blog_container">
            <button id="remove_btn"> Delete </button>
            <a id="bloglink" href="#" >
                <div class="mysavedblogs">
                    <div class="blog">
                        <label class= "title"> Some random text</label>
                        <p id="description">
                            Performed suspicion in certainty so frankness by attention pretended. 
                            Newspaper or in tolerably education enjoyment. Extremity excellent certainty discourse sincerity no he so resembled. 
                            Joy house worse arise total boy.
                        </p>
                        <p class="author&date">
                                Emmanuel Werimegbe on February 17,2020.
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="blog_container">
            <button id="remove_btn"> Delete </button>
            <a id="bloglink" href="#">
                <div class="mysavedblogs">
                    <div class="blog">
                        <label class= "title"> Some random text</label>
                        <p id="description">
                            Performed suspicion in certainty so frankness by attention pretended. 
                            Newspaper or in tolerably education enjoyment. Extremity excellent certainty discourse sincerity no he so resembled. 
                            Joy house worse arise total boy.
                        </p>
                        <p class="author&date">
                                Emmanuel Werimegbe on February 17,2020.
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </body>
    <?php include_once "footer.php";?>
</html>