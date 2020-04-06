<?php 
    require_once "config.php";
    session_start();

    if(!isset($_SESSION["isadmin"]) && !$_SESSION["isadmin"] === true){
        header("location: signin.php");
        exit;
    }
    if(!isset($_GET['blogid'])){
        die("no blog info fot that id");
    }else{
        $blogid=$_GET['blogid'];
    }
    $sql="SELECT blogid,title,description,blog_content,blogimg from blog where blogid='$blogid'";
    $det=$link->query($sql);
    $det->setFetchMode(PDO::FETCH_ASSOC);
    $details=$det->fetch();
    
    $title= $desc= $content= $image = "";
    $title_err= $desc_err= $content_err =$image_err = "";
    $upload_err="not uploaded";


    if($_SERVER["REQUEST_METHOD"] == "POST"){

        //update title
        if(isset($_POST["title"])){
        $title=$_POST["title"];
        $sql="UPDATE blog set title=:title where blogid=:blogid";
        if($stmt=$link->prepare($sql)){
            $stmt->bindParam(":blogid", $param_blogid, PDO::PARAM_STR);
            $stmt->bindParam(":title", $param_title, PDO::PARAM_STR);
            $param_blogid=$blogid;
            $param_title=$title;
            if($stmt->execute()){
                echo "title updated";
            }
            else{
                echo "there was an issue";
            }

        }
        unset($stmt);
    } 
    
        //update desc
        if(isset($_POST["desc"])){
            $desc=$_POST["desc"];
            $sql="UPDATE blog set description=:descr where blogid=:blogid";
            if($stmt=$link->prepare($sql)){
                $stmt->bindParam(":blogid", $param_blogid, PDO::PARAM_STR);
                $stmt->bindParam(":descr", $param_desc, PDO::PARAM_STR);
                $param_blogid=$blogid;
                $param_desc=$desc;
                if($stmt->execute()){
                    echo "description updated";
                }
                else{
                    echo "there was an issue";
                }
            }
            unset($stmt);
        } 

        //update content
        if(isset($_POST["content"])){
            $content=htmlspecialchars($_POST["content"]);
            $sql="UPDATE blog set blog_content=:content where blogid=:blogid";
            if($stmt=$link->prepare($sql)){
                $stmt->bindParam(":blogid", $param_blogid, PDO::PARAM_STR);
                $stmt->bindParam(":content", $param_content, PDO::PARAM_STR);
                $param_blogid=$blogid;
                $param_content=$content;
                if($stmt->execute()){
                    echo "content updated";
                }
                else{
                    echo "there was an issue";
                }
            }
            unset($stmt);
        } 
        
        if(isset($_POST['blog_image'])) 
        {   
            $folder ="upload/"; 
            $image = $_FILES['blog_image']['name'];
            $path = $folder . $image ;
            $target_file=$folder.basename($_FILES["blog_image"]["name"]);
            $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
            $allowed=array('jpeg','png' ,'jpg'); 
            $filename=$_FILES['blog_image']['name']; 
            $ext=pathinfo($filename, PATHINFO_EXTENSION); 
            if(!in_array($ext,$allowed) ) 
        { 
         $image_err= "Sorry, only JPG, JPEG, PNG & GIF  files are allowed.";
        //  echo $image_err;
        }
        else
            if(move_uploaded_file( $_FILES['blog_image'] ['tmp_name'], $path)){
                move_uploaded_file( $_FILES['blog_image'] ['tmp_name'], $path);
                $upload_err="";
            }
            else{
                echo $upload_err;
            }
        
        } 

        //update image
        if(isset($_POST["blog_image"])){
            $image=$_POST["blog_image"];
            $sql="UPDATE blog set blogimg='$image' where blogid=:blogid";
            if($stmt=$link->prepare($sql)){
                $stmt->bindParam(":blogid", $param_blogid, PDO::PARAM_STR);
                $param_blogid=$blogid;
                if($stmt->execute()){
                    echo "image updated";
                    header('location:blogpage.php?blogid='."$blogid");
                }
                else{
                    echo "there was an issue";
                }
            }
            unset($stmt);
        } 
        unset($link);

    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Edit blog</title>
        <link rel="stylesheet" href="../css/editblog.css">
        <link rel="stylesheet" href="../css/highlight.css">
        <script type="text/javascript" src="../js/editblog.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon_io/android-chrome-512x512.png">
    </head>
    <?php require_once "navbar.php"; ?>
    <body>
        <div>
            <h1 >Edit blog</h1>
            <form name="editblog" id="editblog" method="POST" action="">
                <fieldset>
                        <p>
                            <label>Title:</label>
                            <br/>
                            <input id="title" type="text" name="title" value="<?php echo $details['title'];?>" placeholder="Enter your title">
                        </p>
                        <p>
                            <label>Description:</label>
                            <br/>
                            <textarea id="description" type="text" name="desc" placeholder="Enter your description"><?php echo $details['description'];?></textarea>
                        </p>
                        <p>
                            <label>Content:</label>
                            <br/>
                            <textarea id="content" type="text" name="content" placeholder="Enter content for your blog"><?php echo $details['blog_content'];?></textarea>
                        </p>
                        <img src="upload/<?php echo $details['blogimg']?>" alt="" class="img-thumbnail">
                        <p>
                            <label>Upload an image</label>
                            <br/>
                            <input id="blog_image" name="blog_image" type="file" accept="image/*">
                        </p>
                    <button type="submit">Edit your blog</button>
                    <button type="reset">Reset</button>

                </fieldset>
            </form>
        </div>
    </body>
    <?php require_once "footer.php"; ?>
</html>