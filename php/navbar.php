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
                    echo '<li class="nav-item"><a class="nav-link" href="createblog.php">Create Blog</a></li>';
                    echo '<li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Profile Options
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                      echo "<a class='dropdown-item' href=";
                          echo "profile.php?id={$_SESSION['id']}";
                          echo ">Profile</a>";
                          echo "<a class='dropdown-item' href='edit-profile.php'>Edit Profile</a>";
                          echo '</li>';
                          echo '<li class="nav-item"><a class="nav-link" href="savedposts.php">My Saved Blogs</a></li>';
                        }

                      if(isset($_SESSION["isadmin"])){
                        echo '<li class="nav-item"><a class="nav-link" href="adminsearch.php">Admin Search</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="users.php">Manage Users</a></li>';
                      }
                    ?> 
                      <li class="nav-item"><a class="nav-link" href="aboutus.php">About us</a></li>
                      <form class="form-inline" method="POST" action="search.php">
                          <input class="form-control mr-sm-2" name="searchinput" type="search" placeholder="Search for a title" aria-label="Search for a title">
                          <button class="btn btn-danger navbar-btn" type="submit">Search</button>
                      </form>
                <?php 
                     
                        if(isset($_SESSION["loggedin"])||isset($_SESSION["isadmin"])){
                        echo "<li class='nav-item'><a class='nav-link' href='logout.php'>Logout</a></li>";
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