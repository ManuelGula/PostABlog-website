<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"] === true){
        header("location: signin.php");
        exit;
    }else{
        require_once "config.php";
        $userid=$_GET["id"];
        $sql="select firstname,lastname,email,bio,pic from users where userid='$userid'";
        
        $accnt=$link->query($sql);
        $accnt->setFetchMode(PDO::FETCH_ASSOC);
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
        <?php $details=$accnt->fetch();  ?>
        <div id="info" >
            <img  src="<?php echo "profileimages/".$details['pic']?>" alt="" class="img-rounded" >
            <p id="name" ><?php echo $details['firstname']." ".$details['lastname'];?></p>
            <div id="sub_info" >
                    <label for="email">Email:</label>
                    <p id="email"><?php echo $details['email']; ?></p>
            </div>
        </div>
        <div id="bio_content">
            <label >Biography</label>
            <p id="bio">
            <?php echo $details['bio']; ?>
            </p>
        </div>
        <h1 >My Blogs</h1>
        <div class="blog_container" >
            <?php 
                if(isset($_SESSION["loggedin"])&& $_SESSION['id']==true)
                echo '<button id="remove_btn" > Delete </button>';
            ?>
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
    </body>
    <?php include_once "footer.php";?>
</html>