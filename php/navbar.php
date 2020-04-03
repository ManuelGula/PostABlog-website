<header>
        <nav class="navbar navbar-expand-lg navbar-light ">
            <a class="navbar-brand" href="<?php 
            if(isset($_SESSION["loggedin"])){
              echo "blogsfeed.php";
            }
            else
              echo "landing-page.php";
              ?>">CookABlog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav">
                
                <li class="nav-item"><a class="nav-link" href="blogsfeed.php">Blogs</a></li>
                <?php if(isset($_SESSION["loggedin"])){  
                    echo '<li class="nav-item"><a class="nav-link" href="createblog.php">Create Blog</a></li>';}?>
                  <?php
                     if(isset($_SESSION["loggedin"])){ 
                    echo "<li class='nav-item'><a class='nav-link' href=";
                          echo "profile.php?id={$_SESSION['id']}";
                          echo "\">Profile</a></li>";
                        }
                    ?> 
                      <li class="nav-item"><a class="nav-link" href="savedposts.php">My Saved Blogs</a></li>
                      <li class="nav-item"><a class="nav-link" href="aboutus.php">About us</a></li>
                      <form class="form-inline" method="" action="">
                          <input class="form-control mr-sm-2" type="search" placeholder="Search for a title" aria-label="Search for a title">
                          <button class="btn btn-danger navbar-btn" type="submit">Search</button>
                      </form>
                <?php 
                     
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