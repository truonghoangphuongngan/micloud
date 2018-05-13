<?php
include_once("functions.php");

get_header();
?>

<!DOCTYPE html>
<html lang="en">
<div class="container">
    <div class="post">
        <div class="allbox">
            <div><img src="images/images.jpg" alt="logo" style="margin-right: 10px; width: 100px; height:auto; float:right"></div>
            <div>Ten user</div>
        </div>
    </div>
</div>
</html>
<body>

    <div class="container mt-3">

        <div class="media border p-3">
            <img src="img_avatar3.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
            <div class="media-body">
                <h4>John Doe <small><i>Posted on February 19, 2016</i></small></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>      
                <img src="images/images.jpg">
            </div>
        </div>
    </div>

</body>
<?php
get_footer();
?>