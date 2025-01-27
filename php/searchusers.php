<?php
    require_once "config.php";
    session_start();
    $count=$limit="";
    
    
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: blogsfeed.php");
        exit;
    }
    if(!isset($_SESSION["isadmin"]) && !$_SESSION["isadmin"] === true){
        header("location: blogsfeed.php");
        exit;
    }
    if(isset($_POST['searchinput1']) &&isset($_POST['typeofsrch'])&& $_SESSION["isadmin"]){
        $search=$_POST['searchinput1'];
        $srchcat=$_POST['typeofsrch'];
        
        if($srchcat=="name" && isset($search)){
            // echo "works";
            $sql="SELECT userid,firstname,lastname,email from users where firstname like :fname or lastname like :lname";
            // echo "works";
            if($q=$link->prepare($sql)){
                $name="%".$search."%";
                $q->bindParam(':fname',$name);
                $q->bindParam(':lname',$name);
                $q->execute();
            }
            // $q=$link->query($sql);
            // // echo "works";
            // $q->setFetchMode(PDO::FETCH_ASSOC);
                // echo "works";
            $stmt=$link->prepare($sql);
                // echo "works";
                $names="%".$search."%";
                $stmt->bindParam(':fname',$names);
                $stmt->bindParam(':lname',$names);
                // $stmt->execute();

            $stmt->execute();
            // echo "works";
            $count=$stmt->rowCount()==0;
            $limit=$stmt->rowCount();
        }
        // if($srchcat=="lastname"){
        //     $sql="SELECT userid,firstname,lastname,email from users where lastname='$search'";
        //     $q=$link->query($sql);
        //     $q->setFetchMode(PDO::FETCH_ASSOC);

        //     $stmt=$link->prepare($sql);
        //     $stmt->execute();
        //     $count=$stmt->rowCount()==0;
        //     $limit=$stmt->rowCount();
        // }
        if($srchcat=="email"){
            $sql="SELECT userid,firstname,lastname,email from users where email like :email";
            if($q=$link->prepare($sql)){
                $email="%".$search."%";
                $q->bindParam(':email',$email);
                $q->execute();
            }
            $stmt=$link->prepare($sql);
            $email="%".$search."%";
                $stmt->bindParam(':email',$email);
                
            $stmt->execute();
            $count=$stmt->rowCount()==0;
            $limit=$stmt->rowCount();
        }
        if($srchcat=="title"){
            $sql="SELECT blog.userid,firstname,lastname,email,title from users,blog where blog.userid=users.userid and title like :title";
            if($q=$link->prepare($sql)){
                $title="%".$search."%";
                $q->bindParam(':title',$title);
                $q->execute();
            }

            $stmt=$link->prepare($sql);
            $title="%".$search."%";
                $stmt->bindParam(':title',$title);
            $stmt->execute();
            $count=$stmt->rowCount()==0;
            $limit=$stmt->rowCount();
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>Search Users</title>
        <link rel="stylesheet" href="../css/adminsearch.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon_io/android-chrome-512x512.png">
    </head>
    <?php include_once "navbar.php" ?>
    
    <body >
        <h1>Search For Users</h1>
        
        <form  name="searchuser" method="POST" action="">
            <p  class="form-inline" style="margin-left:15%;">
                <input class="form-control mr-sm-2" style="width: 51.5em;" name="searchinput1" type="search" placeholder="Enter text to search" aria-label="Search for a title">
                <button class="btn btn-outline-secondary" name="submit"  type="submit">Search</button>
            </p>
            <div class="input-group mb-3" style="width: 51.5em;margin-left: 15%;">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Search for users by:</label>
                </div>
                <select name="typeofsrch" class="custom-select" id="inputGroupSelect01">
                  <option selected>Choose...</option>
                  <option value="name">Name</option>
                  <!-- <option value="lastname">Lastname</option> -->
                  <option value="email">Email</option>
                  <option value="title">Title</option>
                </select>
              </div>
                
        </form>
        <?php 
                if(!empty($_POST['searchinput1']))
            {
                // echo "<h2>Search results for:".$_POST['searchinput']."</h2>";
                echo '<p id="for">Search for: '.$_POST['searchinput1'].' by '.$_POST['typeofsrch'].'</p>';
            }   
        ?>
        <?php 
        
        //check limit of search
        // if(isset($_SESSION['adminid']))
        if($count){
            
            echo "<h1>No search results for:".$_POST['searchinput1']."</h1>";
        }
        {
        // if(isset($_POST['searchinput']) && isset($_POST['typeofsrch'])){
            
        for($i=0;$i<$limit;$i++){
            // echo "works";
            $r=$q->fetch();
            // echo '<p>'.$r['userid'].'</p>';
        echo "<div style='width:40%;' class='container p-3 my-3 border' >";
            echo "<a id='bloglink' href='profile.php?id={$r['userid']}'>";
                echo "<div class='mysavedblogs'>";
                   echo "<p style='text-align: center;'>
                        Userid: ".$r['userid']."
                    </p>";
                    echo "<div class='blog'>";
                        echo "<p class='title' >Email: ".$r['email']."</p>";
                        echo "<p id='description' >".$r['firstname'].' '.$r['lastname']."
                            
                        </p>
                        <br>
                    </div>
                </div>
            </a>
        </div>";
        }}
    // }}
            
            // if(empty($_POST['searchinput1'])){
            //     echo "<h1>Fill in the form to search</h1>";
            // }
        
        ?>
    </body>
    <?php  include_once "footer.php" ?>
</html>