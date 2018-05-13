<?php
SESSION_START();
include_once("functions.php");
// Neu ko lay duoc username
$username  = '';
$user_id   = 0;
$is_friend = false;
if ( ! isset( $_GET['username'] ) ) {

	// Tra ve trang ca nhan cua minh
	$username = $_SESSION['username'];
	$user_id  = $_SESSION['userID'];

} else {
	// tra ve trang cua username

	$is_friend = true;

	$username = $_GET['username'];

	$user_data = get_content( 'user_by_username', $username );

	$user_id = $user_data[0]['userID'];
}
$posts = get_content( 'postuser', $user_id );


if(isset($_SESSION['userID'])){
    $username = $_SESSION['username'];
    $userID = $_SESSION['userID'];
    $user = get_content('userbyID',$userID);
    
    //update thoong tin
   if (!empty($_POST['update']))
	{
		// Lay data
		//$data['avatar'] = upload_img();
		//if($data['avatar'] == 'fail') {break;}
		$data['fullname'] = $_POST['fullname'];
        $data['email'] = $_POST['email'];
        if($_POST['userpass']==null){
            $data['userpass'] = $user[0]['userpass'];
        }
        else{
            $data['userpass'] = $_POST['userpass'];}
        
	
	
		// Neu ko co loi thi insert
			update_user($userID,$data['fullname'] ,$data['email'] ,$data['userpass']);

	}
  
  //update avatar
  if (!empty($_POST['update_avatar'])){
    // Lay data
		//$data['avatar'] = upload_img();
		//if($data['avatar'] == 'fail') {break;}
		$data['photo'] =  upload_img();
   
 
// Neu ko co loi thi insert
  update_avatar($userID,$data['photo']);

  }
    
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
    <title>Document</title>
</head>

<body>
<!-- header-->
<?php get_header();?>
<!--end header-->

<br>
<div class="container">
    <div class="card-body">
      <form class="form-horizontal" method="post" enctype = "multipart/form-data">
      <div class="allbox">
          <!-- avatar -->
          <div style="margin-right:5%;" class="form-group">
            <div class="card" title="Thay đổi ảnh đại diện">
              <img class="card-img-top" src="<?php echo get_link_avatar( $user_id ); ?>" alt="Card image">                   
            </div>
            <div><label for="avatar">Chọn hình đại diện:</label></div>
            <div><input type="file" class="form-control btn btn-default" id="photor" name="photo"></div>
            <input type="submit" class="btn btn-outline-danger" value="Cập nhật ảnh mới" name="update_avatar">
          </div>
          <!-- info -->
          <div class="form-group">
            <h2><?php echo $username; ?></h2>
            <!-- fullname -->
            <div>
              <label for="fullname">Tên đầy đủ:</label>
              <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Điền tên vào đây" maxlength="30" value="<?php echo $user[0]['fullname']; ?>">
            </div>
            <!-- email -->
            <div>
              <label for="email">Email:</label>
              <div>
                <input type="email" class="form-control" id="email" name="email" placeholder="Điền email" maxlength="30" value="<?php echo $user[0]['email']; ?>">
              </div>
            </div>
            <!-- password -->
            <div>
              <label for="userpass">Password:</label>
              <div>
                <input type="password" class="form-control" id="userpass" name="userpass" placeholder="Điền password mới" maxlength="30" value="<?php ?>">
              </div>
            </div>
            </div>
          </div>
          <!-- SUBMIT -->
          <div style="text-align:right;" class="form-group"> 
              <input type="submit" class="btn btn-outline-danger" value="Cập nhật" name="update">
          </div>
      </div>
      </form>
  </div>
  <br>
</div>
</body>
</html>