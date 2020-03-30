<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="/css/blogpage.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon_io/android-chrome-512x512.png">
    </head>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light ">
            <a class="navbar-brand" href="landing-page.html">CookABlog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="blogsfeed.html">Blogs</a></li>
                <li class="nav-item"><a class="nav-link" href="savedposts.html">My Saved Blogs</a></li>
                <li class="nav-item"><a class="nav-link" href="aboutus.html">About us</a></li>
                <form class="form-inline" method="" action="">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search for a title" aria-label="Search for a title">
                    <button class="btn btn-danger navbar-btn" type="submit">Search</button>
                </form>
                <li class="nav-item"><a class="nav-link" href="landing-page.html">Logout</a></li>
              </ul>
            </div>
        </nav>
    </header>
    <body>
        
        <div id="blog-container">
            <h1>Random text</h1>
            <img id="blog-image" src="../images/welcome_image.jpg" alt="">

            <p id="content" >
            Performed suspicion in certainty so frankness by attention pretended. Newspaper or in tolerably education enjoyment. Extremity excellent certainty discourse sincerity no he so resembled. Joy house worse arise total boy but. Elderly up chicken do at feeling is. Like seen drew no make fond at on rent. Behaviour extremely her explained situation yet september gentleman are who. Is thought or pointed hearing he. 
    
    Extremity direction existence as dashwoods do up. Securing marianne led welcomed offended but offering six raptures. Conveying concluded newspaper rapturous oh at. Two indeed suffer saw beyond far former mrs remain. Occasional continuing possession we insensible an sentiments as is. Law but reasonably motionless principles she. Has six worse downs far blush rooms above stood. 
    
    Spot of come to ever hand as lady meet on. Delicate contempt received two yet advanced. Gentleman as belonging he commanded believing dejection in by. On no am winding chicken so behaved. Its preserved sex enjoyment new way behaviour. Him yet devonshire celebrated especially. Unfeeling one provision are smallness resembled repulsive. 
    
    Believing neglected so so allowance existence departure in. In design active temper be uneasy. Thirty for remove plenty regard you summer though. He preference connection astonished on of ye. Partiality on or continuing in particular principles as. Do believing oh disposing to supported allowance we. 
    
    Case read they must it of cold that. Speaking trifling an to unpacked moderate debating learning. An particular contrasted he excellence favourable on. Nay preference dispatched difficulty continuing joy one. Songs it be if ought hoped of. Too carriage attended him entrance desirous the saw. Twenty sister hearts garden limits put gay has. We hill lady will both sang room by. Desirous men exercise overcame procured speaking her followed. 
                
            </p>
            <div>
                <!-- <label for="author">By</label> -->
                <p id="author" >By <a href="#">Emmanuel Werimegbe</a></p>
                <p id="date_created" >
                    <time datetime="17-02-2020"> February 17,2020.</time>
                </p>
            </div>
        </div>
        <section id="comments-container">
            <p class="comments_section" >Comments</p>
            <div class="comments">
                <p>
                    By <a href="#">Emmanuel Werimegbe</a> on <time datetime="17-02-2020"> February 17,2020.</time>
                </p>
                <p>
                    Life changing.
                </p>
            </div>
            <div class="comments" style="border-style: thin; border-top:dotted; border-width: thin; padding-top: 2%;">
                <p>
                    By <a href="#">Davido</a> on <time datetime="17-02-2020"> February 17,2020.</time>
                </p>
                <p>
                    Life changing, couldnt have said it any better.
                </p>
            </div>
        </section>
        <form id="makeacomment-container" method="" action="">
            <fieldset>
                <p class="comments_section">Leave a comment</p>
                <textarea name="make_a_comment" id="make_a_comment"  rows="2" placeholder="Say something about this blog"></textarea>
                <br/>
                <button id= "submit-comment" type="submit">Submit</button>
            </fieldset>
        </form>
    </body>
        <footer >
            <p>
                <ul>
                    <div class="navbar-header">
                    </div>
                    <li><a href="blogsfeed.html">Blogs</a></li>|
                    <li><a href="savedposts.html">My Saved Blogs</a></li>|
                    <li><a href="aboutus.html">About us</a></li>|
                    <li><a href="adminlogin.html">Admin login</a></li>
                </ul>
                &copy; COSC 360 Project 
            </p>
        </footer>
</html>