<?php 
    session_start();
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
                            <input id="title" type="text" name="title" placeholder="Enter your title">
                        </p>
                        <p>
                            <label>Description:</label>
                            <br/>
                            <textarea id="description" type="text" name="desc" placeholder="Enter your description"></textarea>
                        </p>
                        <p>
                            <label>Content:</label>
                            <br/>
                            <textarea id="content" type="text" name="content" placeholder="Enter content for your blog"></textarea>
                        </p>
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