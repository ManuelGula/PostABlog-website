<?php
    require_once "config.php";
    session_start();
    if(!isset($_GET['id']))
         die("no user info for that id");
    else{
        $userid=$_GET["id"];
        $sql="select firstname,lastname,email,bio,pic from users where userid='$userid'";
        
        $accnt=$link->query($sql);
        $accnt->setFetchMode(PDO::FETCH_ASSOC);

        $blogsql="SELECT username,blogid,title,description,created_date,firstname, lastname from blog,users where blog.userid=users.userid and users.userid='$userid'";
        $blogquery=$link->query($blogsql);
        $blogquery->setFetchMode(PDO::FETCH_ASSOC);
        $delete_err="";
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
        <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon_io/android-chrome-512x512.png">
    </head>
    <?php
        include_once "navbar.php";
        ?>
    <body>
        <?php $details=$accnt->fetch();  ?>
        <div id="info" >
            <img src="<?php echo "profileimages/".$details['pic']?>" alt="" class="img-thumbnail" >
            <div id="sub_info" >
                <p id="name" ><?php echo $details['firstname']." ".$details['lastname'];?></p>
                    <label for="email">Email:</label>
                    <p id="email"><?php echo $details['email']; ?></p>
            </div>
            <div id="bio_content">
                <label >Biography</label>
                <p id="bio">
                <?php echo $details['bio']; ?>
                </p>
            </div>
        </div>
        <br>
        <h1 >My Blogs</h1>
        <?php   
            while($r=$blogquery->fetch()):
                $deleteblogid=$r["blogid"];
                $deletecheck= "SELECT blogid from blog where blogid='$deleteblogid'";
                $delete=$link->query($deletecheck);
                $delete->setFetchMode(PDO::FETCH_ASSOC);
                $blogcheck=$delete->fetch();
                if(isset($blogcheck['blogid'])){
                    if(isset($_SESSION["loggedin"])){
                        if(isset($_REQUEST['removebtn'.$r['blogid']])){
                            // echo "running";
                            if(empty($delete_err)){
                                // echo "running query";
                                $dltqry='DELETE FROM blog where userid=:userid and blogid=:blog_id';
                        
                                if($stmt = $link->prepare($dltqry)){
                                    // Bind variables to the prepared statement as parameters
                                    $stmt->bindParam(':userid',$_SESSION['id']); 
                                    $stmt->bindParam(':blog_id',$deleteblogid); 
                                    // echo "bind successful";
                                    if($stmt->execute()){
                                        //echo "saved";
                                        
                                    } else{
                                        
                                        // echo $save_err;
                                    }
                            
                                    // Close statement
                                    unset($stmt);
                                }
                            }
                        }
                            // echo "there was an error";
                    
                    }
                }
                
                echo '<div class="blog_container">';
                    
                    if(isset($_SESSION["loggedin"]) && ($userid===$_SESSION['id'])&& $_SESSION["loggedin"] === true){
                        if(!isset($_REQUEST['removebtn'.$r['blogid']])){

                            echo '<form id="rmvefrm" name="rmvefrm" method="POST" action="">';
                                echo '<button id="remove_btn" type="submit" name="'."removebtn".$r['blogid'].'"> Delete </button>';
                                echo "</form>";
                            }
                        else{
                            echo '<button id="remove_btn" type="submit" name="'."removebtn".$r['blogid'].'" disabled> Deleted </button>';
                            // echo "Deleted";
                            header("Refresh:1");
                    }}
                    //if(isset($_SESSION["loggedin"])){
                        //if(!isset($_REQUEST['removebtn'.$r['blogid']])){
                            echo "<a id='bloglink' href='blogpage.php?blogid={$r['blogid']}' >";
                            
                        //}}
                        echo '<div class="mysavedblogs" >';
                            echo '<div class="blog">';
                                echo '<label class= "title">Title: '.htmlspecialchars($r['title']).'</label>';
                                echo '<p id="description">';
                                    echo htmlspecialchars($r['description']);
                                echo "</p>";
                                echo '<p class="author&date">By: ';
                                    echo htmlspecialchars($r['firstname'])." ".htmlspecialchars($r['lastname'])." on ".htmlspecialchars($r['created_date']);       
                                echo "</p>
                            </div>
                        </div>";
                        //if(isset($_SESSION["loggedin"])){
                            //if(!isset($_REQUEST['removebtn'.$r['blogid']])){
                                echo "</a>";
                            //}}
                echo "</div>";
        ?>
        <?php endwhile;?>
        <?php 
            if(!isset($blogcheck['blogid'])){
                if(isset($_SESSION["loggedin"])&&isset($_SESSION['id'])===$userid ){
                    echo "<h1>You haven't created a blog yet.</h1>";
                }else{
                    echo "<h1>This user has no posts yet.</h1>";
                }
        }
        
        ?>
    </body>
    <?php include_once "footer.php";?>
</html>