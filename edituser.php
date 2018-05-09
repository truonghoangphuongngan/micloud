<?php
SESSION_START();
include_once("functions.php");
include_once("link-ref.php");

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
  <div class="card bg-light text-dark">
    <div class="card-body">
      <form class="form-horizontal" method="post" enctype = "multipart/form-data">
          <!-- avatar -->
        <div class="form-group">
          <div class="card-body text-center">
                <div class="card" style="width:30%" title="Thay đổi ảnh đại diện">
                    <img class="card-img-top" src="images/upload/<?php get_link_avatar(); ?>" alt="Card image">
                    
                </div>
 
          </div>
        </div>
        <!-- HÌNH ẢNH -->
        <div class="form-group">
          <label class="control-label col-sm-2" for="avatar">Chọn hình đại diện</label>
          <div class="col-sm-8">
            <input type="file" class="form-control btn btn-default" id="photor" name="photo">
          </div>
        </div>
        <!-- SUBMIT -->
        <div class="form-group"> 
          <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-outline-danger" value="Cập nhật" name="update_avatar">
          </div>
        </div>
      </form>

    </div>
  </div>
  <br>

  <div class="card bg-light text-dark">
    <div class="card-body">
      <form class="form-horizontal" method="post" enctype = "multipart/form-data">
        <!-- username -->
        <div class="form-group">
        <div> <h2> <?php echo $username; ?></h2></div>
        </div>
        <!-- fullname -->
        <div class="form-group">
          <label class="control-label col-sm-2" for="fullname">Tên đầy đủ:</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Điền tên vào đây" maxlength="30" value="<?php echo $user[0]['fullname']; ?>">
          </div>
        </div>
        <!-- email -->
        <div class="form-group">
          <label class="control-label col-sm-2" for="email">Email:</label>
          <div class="col-sm-8">
            <input type="email" class="form-control" id="email" name="email" placeholder="Điền email" maxlength="30" value="<?php echo $user[0]['email']; ?>">
          </div>
        </div>
        <!-- password -->
        <div class="form-group">
          <label class="control-label col-sm-2" for="userpass">Password:</label>
          <div class="col-sm-8">
            <input type="password" class="form-control" id="userpass" name="userpass" placeholder="Điền password mới" maxlength="30" value="<?php ?>">
          </div>
        </div>
        
      <!-- SUBMIT -->
        <div class="form-group"> 
          <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-outline-danger" value="Cập nhật" name="update">
          </div>
        </div>
      </form>
    </div>
  </div>




  


</div>
</body>
</html>