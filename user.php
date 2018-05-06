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
<body>
    <?php include_once("header.php");?>
<div>
    <?php get_user_avatar();?>
    <div> <h2> <?php echo $username; ?></h2></div>
    <div><a href="edituser.php">Chỉnh sửa thông tin</a></div>
    <div><a href="newpost.php">Đăng bài</a></div>
    <div><a href="logout.php">Đăng Xuất</a></div>
    


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

</body>
</html>