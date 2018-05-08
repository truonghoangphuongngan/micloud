<?php 
SESSION_START();
include_once("functions.php");
include_once("link-ref.php");

if(isset($_SESSION['userID'])){
    $username = $_SESSION['username'];
    $userID = $_SESSION['userID'];

    $baipost = get_content('postuser',$userID);
    $user = get_content('userbyID',$userID);
    mi_print($user);
    
}else{
    header("location:login.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Micloud | Login</title>
    <?php include_once("link-ref.php");?>
</head>
<style>
.main{
    display: flex;
    background-color: red;
    justify-content: center;
}
.main1{
    display: flex;
    background-color: blue;
    justify-content: center;
}
.main2{
    
    background-color: pink;
    justify-content: center;
}
.main3{
    display: flex;
    background-color: pink;
    justify-content: center;
    
}

.ava img{
    width: 200px;
    height: 500px;
    padding: 30px;
}
</style>
<body>
    <?php include_once("bootrap.php");?>

<div>
    <!-- thông tin-->
<div class="container">
    <div class="card-group">
        <!--avatar-->
        <div class="card bg-light text-dark">
        
            <div class="card-body text-center">
                <div class="card" style="width:30%" title="Thay đổi ảnh đại diện">
                    <img class="card-img-top" src="images/upload/<?php get_user_avatar(); ?>" alt="Card image">
                    
                </div>
 
            </div> 
        </div>
        <!-- end avatar-->

        <div class="card bg-light text-dark">
            <div class="card-body text-center">
                <div class="card-body">
                        <div> <h2> <?php echo $username; ?></h2></div>
                        <div><a href="edituser.php">Chỉnh sửa thông tin</a></div>
                        
                        <div><a href="logout.php" class="btn btn-outline-danger">Đăng Xuất</a></div>
                </div>
            </div>
        </div>
    
    </div>
</div>
    <!--end thông tin-->
<div class="container"
    <div class="card-group">
        <div class="card bg-light text-dark">
        <div class="card-body text-center">
            <div><a href="newpost.php">Đăng bài</a></div>
        </div>
        </div>
    </div>
</div>


<?php

$html="";
foreach($baipost as $post){
    $img = $post['photo'];
    $mota = $post['description'];
    $html .= '<div><img src="images/upload/'.$img.'" alt="'.$mota.'" /></div>';
}

?>

<!-- bài post new-->
<div class="container">
  <h2>Image Gallery</h2>
  <p>Click on the images to enlarge them.</p>
  <div class="row">
    <div class="col-md-4">
      <div class="thumbnail">
        <a href="/w3images/lights.jpg" target="_blank">
          <img src="images/upload/<?php echo $html;?>" alt="Lights" style="width:200%">
         
        </a>
      </div>
    </div>
    
    
  </div>
</div>


<?php

$html="";
foreach($baipost as $post){
    $img = $post['photo'];
    $mota = $post['description'];
    $html .= '<div><img src="images/upload/'.$img.'" alt="'.$mota.'" /></div>';
}
echo $html;
?>


</div>

</body>
</html>