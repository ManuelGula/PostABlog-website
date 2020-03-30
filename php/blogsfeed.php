<?php
    require_once "config.php";

    $sql= 'select title,description, blog_content,created_date,firstname, lastname from blog,users where blog.userid=users.userid';
    $q=$link->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <link rel="stylesheet" href="../css/blogsfeed.css">
        <title>Blogsfeed</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon_io/android-chrome-512x512.png">
    </head>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light ">
            <a class="navbar-brand" href="blogsfeed.php">CookABlog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav">
                
                <li class="nav-item"><a class="nav-link" href="blogsfeed.php">Blogs</a></li>
                <li class="nav-item"><a class="nav-link" href="savedposts.php">My Saved Blogs</a></li>
                <li class="nav-item"><a class="nav-link" href="createblog.php">Create Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="aboutus.php">About us</a></li>
                <form class="form-inline" method="" action="">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search for a title" aria-label="Search for a title">
                    <button class="btn btn-danger navbar-btn" type="submit">Search</button>
                </form>
                <?php 
                    session_start(); 

                    if(isset($_SESSION["loggedin"])){
                        echo "<li class='nav-item'><a class='nav-link' href='logout.php'>logout</a></li>";
                    }
                    else{
                        echo "<li class='nav-item'><a class='nav-link' href='signin.php'>Sign in</a></li>";
                        echo "<li class='nav-item'><a class='nav-link' href='signup.php'>Sign up</a></li>"; 
                        }
                ?>
              </ul>
            </div>
        </nav>
    </header>
    
    <body >
        <h1>Browse Blogs</h1>
        <?php while($r=$q->fetch()): 
        echo '<div class="blog_container" >';
            echo '<button id="save_btn"> Save </button>';
            echo '<a id="bloglink" href="#">';
                echo '<div class="mysavedblogs">';
                    echo '<div class="blog">';
                        
                        echo '<label class= "title" >'.htmlspecialchars($r['title']).'</label>';
                        echo '<p id="description" >';
                            echo htmlspecialchars($r['description']) ;
                        echo "</p>";
                        echo '<p class="author&date">';
                            echo htmlspecialchars($r['firstname'])." ".htmlspecialchars($r['lastname'])." on ".htmlspecialchars($r['created_date']);       
                        echo  '</p>';
                        ?>
                    </div>
                </div>
            </a>
        </div>
        <?php endwhile;?>
    </body>
    <footer>
        <p>
            <ul>
                <div class="navbar-header" >
                </div>
                <li><a href="blogsfeed.php">Blogs</a></li>|
                <li><a href="savedposts.php">My Saved Blogs</a></li>|
                <li><a href="aboutus.php">About us</a></li>|
                <li><a href="adminlogin.php">Admin login</a></li>
            </ul>
            &copy; COSC 360 Project 
        </p>
    </footer>
</html>