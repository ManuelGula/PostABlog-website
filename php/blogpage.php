<?php
    require_once "config.php";
    session_start();
    if(!isset($_GET['blogid']))
        die("no blog info for that id");
    else{
        $blogid=$_GET['blogid'];
        $sql="SELECT blog.userid,title,description, blog_content,created_date,firstname,lastname,blogimg from blog,users where blog.userid=users.userid and blogid='$blogid'";
        $q=$link->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);

        $commentsql="SELECT com_id,comment.userid,com_content,comment.blogid,firstname,lastname,datecreated from comment,users,blog  where comment.blogid=blog.blogid and comment.userid=users.userid and comment.blogid='$blogid' order by datecreated DESC ";
        $com=$link->query($commentsql);
        $com->setFetchMode(PDO::FETCH_ASSOC);

        $commCount=$link->prepare($commentsql);
        $commCount->execute();
    }
    // session_start();
    if(isset($_SESSION["loggedin"])){
        $comment=$comment_err="";
        
        if($_SERVER["REQUEST_METHOD"]== "POST"){
            if(empty(trim($_POST["make_a_comment"]))){
                $comment_err = "Please enter a comment ";
            }else{
                $comment = trim($_POST["make_a_comment"]);
            }
        }
        if(isset($_REQUEST['submit-comment'])){
            if(empty($comment_err)){
            $sql="INSERT INTO comment(userid,com_content,blogid) values(:userid,:comment,:blogid)";
        
            if($stmt = $link->prepare($sql)){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(':userid',$_SESSION["id"]); 
                    $stmt->bindParam(':blogid',$_GET['blogid']); 
                    $stmt->bindParam(':comment',$comment); 
                
                    if($stmt->execute()){
                        header("location: blogpage.php?blogid=".$blogid);
                        
                        
                    } else{
                        echo "Something went wrong. Please try again later.";
                    }
            
                    // Close statement
                    unset($stmt);
                }
            }
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>BlogPage</title>
        <link rel="stylesheet" href="../css/blogpage.css">
        <link rel="stylesheet" href="../css/highlight.css">
        <script type="text/javascript" src="../js/comment.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon_io/android-chrome-512x512.png">
    </head>
    <?php  include_once "navbar.php"; ?>
    <body>
        <?php 
             $r=$q->fetch();
        ?>
        <div id="blog-container">
            <h1><?php echo $r['title']; ?></h1>
            <img id="blog-image" src= "upload/<?php echo $r['blogimg']; ?>" alt="" class="img-thumbnail">

            <p id="content" >
                <?php echo $r['blog_content']; ?>
            </p>
            <div>
                <!-- <label for="author">By</label> -->
                <p id="author" >By <a href="
                    <?php 
                          echo "profile.php?id={$r['userid']}";
                    ?>"><?php echo $r['firstname']." ".$r['lastname'];  ?></a></p>
                <p id="date_created" >
                    <time datetime="17-02-2020"> <?php echo "on ".$r['created_date']; ?></time>
                </p>
            </div>
        </div>
        <br>
        <section id="comments-container">
            <p class="comments_section" >Comments</p>
            <?php
                if($commCount->rowCount()==0){
                    echo "<em>No comments on this post yet</em>";
                }
                
                while($comments=$com->fetch()): 
                $comid=$comments["com_id"];
                $deletecheck= "SELECT com_id from comment where com_id='$comid'";
                $delete=$link->query($deletecheck);
                $delete->setFetchMode(PDO::FETCH_ASSOC);
                $comcheck=$delete->fetch();
                if(isset($comcheck['com_id'])){
                    // echo "running";
                    if(isset($_SESSION["isadmin"])){
                        // echo "running";
                        if(isset($_REQUEST['deletecom'.$comments['com_id']])){
                            // echo "running";
                            if(empty($delete_err)){
                                // echo "running query";
                                $dltqry='DELETE FROM comment where com_id=:comid';
                        
                                if($stmt = $link->prepare($dltqry)){
                                    // Bind variables to the prepared statement as parameters
                                    $stmt->bindParam(':comid',$comid); 
                                    // echo "bind successful";
                                    if($stmt->execute()){
                                        // echo "successful";
                                        
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

                  echo  '<div class="comments">
                        <p>
                            By <a href='."profile.php?id={$comments['userid']}".'>'.htmlspecialchars($comments['firstname'])." ".htmlspecialchars($comments['lastname']).'</a> on <time datetime="17-02-2020">'.htmlspecialchars($comments['datecreated']).'</time>
                        </p>
                        <br>
                        <p>
                            <em>'.htmlspecialchars($comments['com_content']).'</em>
                        </p>';
                        if(isset($_SESSION["isadmin"]) && $_SESSION["isadmin"] === true){
                            if(!isset($_REQUEST['deletecom'.$comments['com_id']])){
                            echo '<br>
                            <form id="deletecomment" name="deletcomment" method="POST" >
                                <button id="delete" name="deletecom'.$comments['com_id'].'" type="submit">Delete Comment</button>
                            <form>';}
                            else{
                            echo '<br>
                            <form id="deletecomment" name="deletcomment" method="POST" >
                                <button id="delete" name="deletecom'.$comments['com_id'].'" type="submit" disabled>Deleted</button>
                            <form>';
                            
                            }
                        }
                      echo  '</div>';
                ?>
                <?php endwhile;?>
        </section>
        <?php
            if(isset($_SESSION["loggedin"])){
            echo '<form id="makeacomment-container" name="comment" method="POST" action="">
                    <fieldset>
                        <p class="makecomm">Leave a comment</p>
                        <textarea name="make_a_comment" id="make_a_comment"  rows="2" placeholder="Say something about this blog"></textarea>
                        <br/>
                        <button id= "submit-comment" name="submit-comment" type="submit">Submit</button>
                    </fieldset>
                </form>';
            }
        ?>
    </body>
        <?php include_once "footer.php" ?>
</html>