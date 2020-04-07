<?php
// Include config file
require_once "config.php";
 
session_start();
if((isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) ||(isset($_SESSION["isadmin"]) && $_SESSION["isadmin"] === true) ){
    header("location: blogsfeed.php");
    exit;
} 
// Define variables and initialize with empty values
$firstname= $lastname= $username= $email = $password = $confirm_password= $bio= $image =  "";
$firstname_err= $lastname_err= $username_err =$email_err = $password_err = $confirm_password_err =$bio_err= $image_err = "";
$upload_err="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    //validate firstname
    if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Please enter a first name.";
    } else{
        $firstname = trim($_POST["firstname"]);
    }

    //validate lastname
    if(empty(trim($_POST["lastname"]))){
        $lastname_err = "Please enter a last name.";
    } else{
        $lastname = trim($_POST["lastname"]);
    }
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT userid FROM users WHERE username = :username";
        
        if($stmt = $link->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                // echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }

    //validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
     } else{
        // Prepare a select statement
        $sql = "SELECT userid FROM users WHERE email = :email";
        
        if($stmt = $link->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                // echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["re-password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["re-password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    //validate bio
    if(empty(trim($_POST["bio"]))){
        $bio_err = "Please enter a bio.";
    } else{
        $bio = trim($_POST["bio"]);
    }

    // upload image to be done...
    if(isset($_POST['submit'])) 
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
            } 
            else{
                echo $upload_err="not uploaded";
            }
        } 

    // Check input errors before inserting in database
    if(empty($firstname_err) && empty($lastname_err) && empty($email_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($bio_err)&& empty($image_err)&& empty($upload_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (firstname, lastname, username, email, pass, bio,pic) VALUES (:firstname, :lastname, :username, :email, :password, :bio, :image)";
         
        if($stmt = $link->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":firstname", $param_firstname, PDO::PARAM_STR);
            $stmt->bindParam(":lastname", $param_lastname, PDO::PARAM_STR);
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":bio", $param_bio, PDO::PARAM_STR);
            $stmt->bindParam(':image',$image); 
            // Set parameters
            $param_firstname=$firstname;
            $param_lastname=$lastname;
            $param_username = $username;
            $param_email=$email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_bio=$bio;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: signin.php");
            } else{
                // echo "Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    else{
        // echo "something went wrong";
    }
    
    // Close connection
    unset($link);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Sign Up</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/sign-up.css"> 
        <link rel="stylesheet" href="../css/highlight.css">
        <script type="text/javascript" src="../js/signup.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon_io/android-chrome-512x512.png">
    </head>
    <?php include_once "navbar.php"; ?>
    <body>
        <h1>Sign Up</h1>
        <div >
            <form name="signup" id="signup" method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
                <fieldset >
                        <div>
                        <?php echo "<p style='text-align:center;color:Red;font-weight:bold'>".$firstname_err."</p>"; ?>
                            <p>
                                <label>Firstname:</label>
                                <br/>
                                <input id="firstname" type="text" name="firstname" placeholder="Enter your firstname">
                            </p>
                            <?php echo "<p style='text-align:center;color:Red;font-weight:bold'>".$lastname_err."</p>"; ?>
                            <p>
                                <label>Lastname:</label>
                                <br/>
                                <input id="lastname" type="text" name="lastname" placeholder="Enter your lastname">
                            </p>
                        </div>
                        <?php echo "<p style='text-align:center;color:Red;font-weight:bold'>".$username_err."</p>"; ?>
                        <p>
                            <label>Username:</label>
                            <br/>
                            <input id="username" type="text" name="username" placeholder="Enter your username">          
                        </p>
                        <?php echo "<p style='text-align:center;color:Red;font-weight:bold'>".$email_err."</p>"; ?>
                        <p>
                            <label>Email:</label>
                            <br/>
                            <input id="email"  type="email" name="email" placeholder="Enter your email">
                        </p>
                        <div>
                        <?php echo "<p style='text-align:center;color:Red;font-weight:bold'>".$password_err."</p>"; ?>
                            <p>
                                <label>Password:</label>
                                <br/>
                                <input id="password" type="password" name="password" placeholder="Enter your password">
                            </p>
                            <?php echo "<p style='text-align:center;color:Red;font-weight:bold'>".$confirm_password_err."</p>"; ?>
                            <p>
                                <label>Retype Password:</label>
                                <br/>
                                <input id="retype-password" type="password" name="re-password" placeholder="Retype your password">
                            </p>
                        </div>
                        <?php echo "<p style='text-align:center;color:Red;font-weight:bold'>".$bio_err."</p>"; ?>
                        <div>
                            <p> 
                                <label>Bio:</label>
                                <br/>
                                <textarea id="bio" name="bio" rows="3" placeholder="Tell us something about yourself"></textarea>
                            </p>
                        </div>
                        <?php echo "<p style='text-align:center;color:Red;font-weight:bold'>".$upload_err."</p>"; ?>
                        <p>
                            <label>Add profile image</label>
                            <br/>
                            <input id="prof_image" name="prof_image" type="file" accept="image/*">
                        </p>
                    <button name="submit" type="submit">Submit</button>
                    <button type="reset">Reset</button>

                </fieldset>
            </form>
        </div>
    </body>
    <?php include_once "footer.php" ?>
</html>