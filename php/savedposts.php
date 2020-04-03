<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"] === true){
        header("location: signin.php");
        exit;
    }
    require_once "config.php";
    $userid=$_SESSION['id'];
    $blogsql="SELECT savedblogs.blog_id,title,description,created_date,firstname, lastname from savedblogs,blog,users where savedblogs.blog_id=blog.blogid and savedblogs.userid=users.userid and savedblogs.userid=$userid";
    $blogquery=$link->query($blogsql);
    $blogquery->setFetchMode(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/savedposts.css">
        <title>Saved Blogs</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon_io/android-chrome-512x512.png">
    </head>
    <?php  include_once "navbar.php" ?>
    <body >
        <h1>Saved Blogs</h1>
        <?php while($r=$blogquery->fetch()):

            $deleteblogid=$r["blog_id"];
            $deletecheck= "SELECT blog_id from savedblogs where blog_id='$deleteblogid' and userid='$userid'";
            $delete=$link->query($deletecheck);
            $delete->setFetchMode(PDO::FETCH_ASSOC);
            $blogcheck=$delete->fetch();
            if(isset($blogcheck['blog_id'])){
                if(isset($_SESSION["loggedin"])){
                    if(isset($_REQUEST['removebtn'.$r['blog_id']])){
                        // echo "running";
                        if(empty($delete_err)){
                            // echo "running query";
                            $dltqry='DELETE FROM savedblogs where userid=:userid and blog_id=:blog_id';
                    
                            if($stmt = $link->prepare($dltqry)){
                                // Bind variables to the prepared statement as parameters
                                $stmt->bindParam(':userid',$_SESSION['id']); 
                                $stmt->bindParam(':blog_id',$deleteblogid); 
                                // echo "bind successful";
                                if($stmt->execute()){
                                    // echo "saved";
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
                
                if(isset($_SESSION["loggedin"])){
                    if(!isset($_REQUEST['removebtn'.$r['blog_id']])){
                    echo '<form id="rmvefrm" name="rmvefrm" method="POST" action="">';
                        echo '<button id="remove_btn" type="submit" name="'."removebtn".$r['blog_id'].'"> Delete </button>';
                        echo "</form>";}
                else{
                    echo '<button id="remove_btn" type="submit" name="'."removebtn".$r['blog_id'].'" disabled> Deleted </button>';
                    // echo "Deleted";
                    header("Refresh:1");
                }}
                //if(isset($_SESSION["loggedin"])){
                    //if(!isset($_REQUEST['removebtn'.$r['blog_id']])){
                        echo "<a id='bloglink' href='blogpage.php?blogid={$r['blog_id']}' >";
                    //}}
                    echo '<div class="mysavedblogs" >';
                        echo '<div class="blog">';
                            echo '<label class= "title"> '.htmlspecialchars($r['title']).'</label>';
                            echo '<p id="description">';
                                echo htmlspecialchars($r['description']);
                            echo "</p>";
                            echo '<p class="author&date">';
                                echo htmlspecialchars($r['firstname'])." ".htmlspecialchars($r['lastname'])." on ".htmlspecialchars($r['created_date']);       
                            echo "</p>
                        </div>
                    </div>";
                    //if(isset($_SESSION["loggedin"])){
                      //  if(!isset($_REQUEST['removebtn'.$r['blog_id']])){
                            echo "</a>";
                        //}}
            echo "</div>";
            ?>
            <?php endwhile;?>
            <?php  if(!isset($blogcheck['blog_id'])){
            echo "<h1>You havent saved a blog yet.</h1>";
            }
    
            ?>
    </body>
   <?php include_once "footer.php";?>
</html>