<?php 
require_once "config.php";
session_start();

if(!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"] === true){
    header("location: signin.php");
    exit;
}
$firstname= $lastname= $username= $email = $password = $confirm_password= $bio= $image =  "";
$upload_err="not uploaded";
$userid=$_SESSION["id"];
$acctsql="select userid,firstname,lastname,email,bio,pic from users where userid='$userid'";

$accnt=$link->query($acctsql);
$accnt->setFetchMode(PDO::FETCH_ASSOC);
$r=$accnt->fetch();
    

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    //update firstname
    if(isset($_POST["firstname"])){
        $firstname=$_POST["firstname"];
        $sql="UPDATE users set firstname='$firstname' where userid=:userid";
        if($stmt=$link->prepare($sql)){
            $stmt->bindParam(":userid", $param_id, PDO::PARAM_STR);
            $param_id=$userid;
            if($stmt->execute()){
                echo "firsname updated";
            }
            else{
                echo "there was an issue";
            }

        }
        unset($stmt);
    } 
    //update lastname
    if(isset($_POST["lastname"])){
        $lastname=$_POST["lastname"];
        $sql="UPDATE users set lastname='$lastname' where userid=:userid";
        if($stmt=$link->prepare($sql)){
            $stmt->bindParam(":userid", $param_id, PDO::PARAM_STR);
            $param_id=$userid;
            if($stmt->execute()){
                echo "lastname updated";
            }
            else{
                echo "there was an issue";
            }

        }
        unset($stmt);
    } 

    //update bio
    if(isset($_POST["bio"])){
        $bio=$_POST["bio"];
        $sql="UPDATE users set bio='$bio' where userid=:userid";
        if($stmt=$link->prepare($sql)){
            $stmt->bindParam(":userid", $param_id, PDO::PARAM_STR);
            $param_id=$userid;
            if($stmt->execute()){
                echo "bio updated";
            }
            else{
                echo "there was an issue";
            }

        }
        unset($stmt);
    } 

    //update email
    if(isset($_POST["email"])){
        // Prepare a select statement
        $email=$_POST["email"];
        $sql="UPDATE users set email='$email' where userid=:userid";

        
        if($stmt = $link->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":userid", $param_id, PDO::PARAM_STR);
            
            // Set parameters
            $param_id = $userid;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if(($stmt->rowCount()==0)&&($userid===$r['userid']) ){
                    echo "email remained the same";
                    
                } else{
                    echo "email updated";
                    // header('location:profile.php?id='."$userid");

                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }


    // upload image 
    if(!isset($_POST['prof_image'])) 
    {   
            $folder ="profileimages/"; 
            $image = $_FILES['prof_image']['name']; 
            $path = $folder . $image ;
            $target_file=$folder.basename($_FILES["prof_image"]["name"]);
            $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
            $allowed=array('jpeg','png' ,'jpg'); 
            $filename=$_FILES['prof_image']['name']; 
            $ext=pathinfo($filename, PATHINFO_EXTENSION); 
            if(!in_array($ext,$allowed) ){ 
                $image_err= "Sorry, only JPG, JPEG, PNG & GIF  files are allowed.";
            }
            else
                if(move_uploaded_file( $_FILES['prof_image'] ['tmp_name'], $path)){
                    move_uploaded_file( $_FILES['prof_image'] ['tmp_name'], $path);
                    $upload_err="";
                    echo "uploaded";
                } 
                else{
                    echo $upload_err;
                }
        
    }

    // update image
    if(empty($upload_err)){
        $sql= "UPDATE users set pic='$image' where userid=:userid";
        if($stmt=$link->prepare($sql)){
            $stmt->bindParam(":userid", $param_id, PDO::PARAM_STR);
            $param_id=$userid;
            if($stmt->execute()){
                echo "image updated";
                header('location:profile.php?id='."$userid");
            }
            else{
                echo "there was an issue";
            }

        }
        unset($stmt);
    }
    else{
        header('location:profile.php?id='."$userid");
        // echo "image remained the same ";
    }

    // Close connection
    unset($link);

}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/editprofile.css">
        <link rel="stylesheet" href="../css/highlight.css">
        <script type="text/javascript" src="../js/editprofile.js"></script>
        <title>Edit Profile</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon_io/android-chrome-512x512.png">
    </head>
    <?php include_once "navbar.php" ?>
    <body>
    <?php $details=$accnt->fetch();  ?>
        <h1>Edit Profile</h1>
        <div >
            <form name="editprofile" id="editprofile" enctype="multipart/form-data" method="POST" action="" >
                <fieldset >
                        <div>
                            <p>
                                <label>Firstname:</label>
                                <br/>
                                <input id="firstname" type="text" name="firstname" value="<?php echo $r['firstname'];?> ">
                            </p>
                            <p>
                                <label>Lastname:</label>
                                <br/>
                                <input id="lastname" type="text" name="lastname" value="<?php echo $r['lastname'];?> ">
                            </p>
                        </div>
                        <p>
                            <label>Email:</label>
                            <br/>
                            <input id="email" type="email" name="email" value="<?php echo $r['email']?> ">
                        </p>

                        <p> 
                            <label>Bio:</label>
                            <br/>
                            <textarea id="bio" name ="bio" rows="5" ><?php echo $r['bio'];?></textarea>
                        </p>
                        <img src="profileimages/<?php echo $r['pic']?>" alt="" class="img-thumbnail">
                        <p>
                            <label>Change profile image</label>
                            <br/>
                            <input id="prof_image" name="prof_image" type="file" accept="image/*">
                        </p>
                    <button type="submit">Submit</button>
                    <button type="reset">Reset</button>

                </fieldset>
            </form>
        </div>
    </body>
    <footer >
        <p >
            <ul>
                <div class="navbar-header" >
                <li><a href="blogsfeed.html">Blogs</a></li>|
                <li><a href="savedposts.html">My Saved Blogs</a></li>|
                <li><a href="aboutus.html">About us</a></li>|
                <li><a href="adminlogin.html">Admin login</a></li>
                </div>
            </ul>
            &copy; COSC 360 Project 
        </p>
    </footer>
</html>