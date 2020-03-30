<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$title= $desc= $content= $image = "";
$title_err= $desc_err= $content_err =$image_err = "";

session_start();

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    //validate title
    if(empty(trim($_POST["title"]))){
        $title_err = "Please enter a title ";
    } else{
        $title = trim($_POST["title"]);
    }

    //validate desc
    if(empty(trim($_POST["desc"]))){
        $desc_err = "Please enter a description.";
    } else{
        $desc = trim($_POST["desc"]);
    }
    //validate content
    if(empty(trim($_POST["content"]))){
        $content_err = "Please enter content.";
    } else{
        $content = trim($_POST["content"]);
    }
    
    // validate image upload
    // if (count($_FILES) > 0) {
    //     if (is_uploaded_file($_FILES['blog_image']['tmp_name'])) {
    //         $image = file_get_contents($_FILES['blog_image']['tmp_name']);   
    //     }
    //     else{
    //         $image_err = "Please enter content.";
    //     }
    // }

    if(isset($_POST['submit'])) 
    {   
        $folder ="../upload/"; 
        $image = $_FILES['blog_image']['name']; 
        $path = $folder . $image ;
        $target_file=$folder.basename($_FILES["blog_image"]["name"]);
        $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
        $allowed=array('jpeg','png' ,'jpg'); 
        $filename=$_FILES['blog_image']['name']; 
        $ext=pathinfo($filename, PATHINFO_EXTENSION); if(!in_array($ext,$allowed) ) 
    { 
     $image_err= "Sorry, only JPG, JPEG, PNG & GIF  files are allowed.";
    }
    else{ 
        move_uploaded_file( $_FILES['blog_image'] ['tmp_name'], $path); 
        // $sth=$link->prepare("insert into blog(blogimg)values(:image) "); 
        
        // $sth->execute();     
    } 
} 
    

    // upload image to be done...

    // Check input errors before inserting in database
    if(empty($title_err) && empty($desc_err) && empty($content_err) && empty($image_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO blog (userid, title, description, blog_content,blogimg) VALUES (:userid ,:title, :description, :blog_content,:image)";
         
        if($stmt = $link->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":userid", $param_userid, PDO::PARAM_STR);
            $stmt->bindParam(":title", $param_title, PDO::PARAM_STR);
            $stmt->bindParam(":description", $param_desc, PDO::PARAM_STR);
            $stmt->bindParam(":blog_content", $param_content, PDO::PARAM_STR);
            $stmt->bindParam(':image',$image); 
            // $stmt->bindParam(":blogimg", $param_img, PDO::PARAM_STR);
            
            // Set parameters
            $param_userid=$_SESSION["id"];
            $param_title=$title;
            $param_desc = $desc;
            $param_content=$content;
            // $param_blogimg=$image;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: blogsfeed.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($link);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Write your blog</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/createblog.css">
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
                <li class="nav-item"><a class="nav-link" href="aboutus.php">About us</a></li>
                <form class="form-inline" method="" action="">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search for a title" aria-label="Search for a title">
                    <button class="btn btn-danger navbar-btn" type="submit">Search</button>
                </form>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
              </ul>
            </div>
        </nav>
    </header>
    <body>
        <h1>Create a blog</h1>
        <div>
            <form id="editblog" name="createblog" enctype="multipart/form-data" method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return validateform()">
                <fieldset>
                        <p>
                            <label>Title:</label>
                            <br/>
                            <input id="title" type="text" name="title" placeholder="Enter your blog's title">
                        </p>
                        <p>
                            <label>Description:</label>
                            <br/>
                            <textarea id="desc" rows="3" name="desc" placeholder="Enter your description"></textarea>
                        </p>
                        <p>
                            <label>Content:</label>
                            <br/>
                            <textarea id="content" rows="10" name="content" placeholder="Enter your content for your blog"></textarea>
                        </p>
                        <p>
                            <label>Upload an image</label>
                            <br/>
                            <input id="blog_image" name="blog_image" type="file" accept="image/*">
                        </p>
                    <button name="submit" type="submit">Post your blog</button>
                    <button type="reset">Reset</button>

                </fieldset>
            </form>
        </div>
        <script>
            function validateform(){
                var title=document.forms["editblog"]["title"].value;
                var description=document.getElementById("desc").value;
                var content=document.getElementById("content").value;
                var image=document.forms["editblog"]["blog_image"].value;
                if(title==""||title==null){
                    alert("Enter a title");
                    return false;
                }
                if(description==""||description==null){
                    alert("Enter a description");
                    return false;
                }
                if(content==""||content==null){
                    alert("Fill in your content.");
                    return false;
                }
                if(image==""|| image==null){
                    alert("you must upload an image");
                    return false;
                }
            }
        </script>
    </body>
    <footer>
        <p>
            <ul>
                <li><a href="blogsfeed.php">Blogs</a></li>|
                <li><a href="savedposts.php">My Saved Blogs</a></li>|
                <li><a href="aboutus.php">About us</a></li>|
                <li><a href="adminlogin.php">Admin login</a></li>
            </ul>
            &copy; COSC 360 Project 
        </p>
    </footer>
</html>