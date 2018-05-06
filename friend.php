<?php 
SESSION_START();
include_once("functions.php");
include_once("link-ref.php");
$user_friend_ID = $_GET["userID"];
if($user_friend_ID == $_SESSION['userID']){
    header("location:user.php");

}
$userID = $_SESSION['userID'];
$user_friend = get_content('userbyID',$user_friend_ID);
$username_friend = $user_friend[0]['username'];
$baipost = get_content('postuser',$user_friend_ID);

if(!empty($_POST['follow'])){
    follow_friend($username_friend, $userID);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php include_once("header.php");?>
<div>
    <?php get_user_avatar($user_friend_ID);?>
    <div><h2><?php echo $username_friend; ?></h2></div>
    <div>
        <form action="" method="post">
            <input type="submit" id="follow" name="follow" value="Theo dõi">

        </form>
        
    
    


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