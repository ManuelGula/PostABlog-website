<?php
    require_once "config.php";
    session_start();
    if(isset($_SESSION["loggedin"])){
        $userid=$_SESSION['id'];
    }
    $sql= 'SELECT username,blogid,title,description, blog_content,created_date,firstname, lastname from blog,users where blog.userid=users.userid ORDER BY created_date DESC';
    $q=$link->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $save_err="";
    $saved_err="Already saved blog";
    $blogCnt = $link->prepare($sql);
    $blogCnt->execute();
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
    <?php  include_once "navbar.php"; ?>
    <body >
        <h1>Browse Blogs</h1>
        
        <?php 
        if($blogCnt->rowCount()==0){
            echo "<h2>No Blogs here. Go Create one </em>";
        }
        while($r=$q->fetch()): 
        $savedblogid=$r["blogid"];
        if(isset($_SESSION["loggedin"])){
        $savecheck= "SELECT blog_id from savedblogs where blog_id='$savedblogid' and userid='$userid'";
        $svck=$link->query($savecheck);
        $svck->setFetchMode(PDO::FETCH_ASSOC);
        $blogcheck=$svck->fetch();
        if(!isset($blogcheck['blog_id'])){
            if(isset($_SESSION["loggedin"])){
                if(isset($_REQUEST['saveblog'.$r['blogid']])){
                    // echo "running";
                    if(empty($save_err)){
                        // echo "running query";
                        $saveqry="INSERT INTO savedblogs (userid,blog_id) VALUES(:userid,:blogid)";
                
                        if($stmt = $link->prepare($saveqry)){
                            // Bind variables to the prepared statement as parameters
                            $stmt->bindParam(':userid',$_SESSION["id"]); 
                            $stmt->bindParam(':blogid',$r['blogid']); 
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
                }
            }
        }

    if(isset($_SESSION["isadmin"])){
        $blgdel_err="";
        $deleteblogid=$r["blogid"];
        $deletecheck= "SELECT blogid from blog where blogid='$deleteblogid'";
        $delete=$link->query($deletecheck);
        $delete->setFetchMode(PDO::FETCH_ASSOC);
        $blogcheck1=$delete->fetch();
        if(isset($blogcheck1['blogid'])){
            // echo "running";
            if(isset($_SESSION["isadmin"])){
                // echo "running";
                if(isset($_REQUEST['deleteblog'.$r['blogid']])){
                    // echo "running";
                    if(empty($delete_err)){
                        // echo "running query";
                        $dltqry='DELETE FROM blog where blogid=:blog_id';
                
                        if($stmt = $link->prepare($dltqry)){
                            // Bind variables to the prepared statement as parameters
                            $stmt->bindParam(':blog_id',$deleteblogid); 
                            // echo "bind successful";
                            if($stmt->execute()){
                                // echo "deleted";
                            } else{
                                $blgdel_err="not deleted";
                                echo $blgdel_err;
                            }
                    
                            // Close statement
                            unset($stmt);
                        }
                    }
                }
                    // echo "there was an error";
            
            }
        }
    }
            
                
                    // echo "there was an error";
    echo '<div class="blog_container" >';
    
        if(isset($_SESSION["loggedin"]) ){
            if(isset($_REQUEST['saveblog'.$r['blogid']])){
                echo '<button id="action_btn" name="'."saveblog".$r['blogid'].'"disabled> Saved </button>';
            }
            else{
                echo '<form id="savefrm" name="savefrm" method="POST" action="">';
                    echo '<button id="action_btn" type="submit" name="'."saveblog".$r['blogid'].'"> Save </button>';
                    echo "</form>";
            }
        }
        
        if(isset($_SESSION["isadmin"]) ){
            if(isset($_REQUEST['deleteblog'.$r['blogid']])){
                echo '<button id="action_btn" name="'."deleteblog".$r['blogid'].'"disabled> Deleted </button>';
                header("Refresh:1");
            }
            else{
                // echo "<form id='editfrm' name='editfrm' method='POST' action='editblog.php?blogid={$r['blogid']}'>";
                // echo '<button id="action_btn" type="submit" name="'."editblog".$r['blogid'].'"> Edit </button>';
                // echo "</form>";
                echo '<form id="deletefrm" name="deletefrm" method="POST" action="">';
                echo '<button id="delete_btn" type="submit" name="'."deleteblog".$r['blogid'].'"> Delete </button>';
                echo "</form>";
            }
        }
        if(isset($blogcheck['blog_id']) && isset($_REQUEST['saveblog'.$r['blogid']])){
                echo "<p style='color:red;font-weight:bold'>".$saved_err."</p>";
        }

        echo "<a id='bloglink' href='blogpage.php?blogid={$r['blogid']}'>";
        echo '<div class="mysavedblogs">';
                echo '<div class="blog">';
                    
                    echo '<label class= "title" >Title: '.htmlspecialchars($r['title']).'</label>';
                    echo '<p id="description" >';
                        echo htmlspecialchars($r['description']) ;
                    echo "</p>";
                    echo '<p class="author&date">By: ';
                        echo htmlspecialchars($r['firstname'])." ".htmlspecialchars($r['lastname'])." on ".htmlspecialchars($r['created_date']);       
                    echo  '</p>';
                echo "</div>";
                echo "</div>";
                echo "</a>";
    echo "</div>";
    
    ?>
    <?php endwhile;?>
    </body>
    <?php include_once "footer.php"?>
</html>