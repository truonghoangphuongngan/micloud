<?php 
SESSION_START();
include_once("functions.php");

// Nếu người dùng submit form
if (!empty($_POST['login']))
{
	//Lấy dữ liệu nhập vào
	$data['username'] = $_POST['username'];
	$data['password'] = $_POST['pwd'];
	
	sign_in($data['username'],$data['password']);
}
disconnect_db();
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
<div class="row login">



<div class="col-lg-12 col-sm-12">
<div class="well">Bạn chưa đăng nhập. Hãy đăng nhập!</div>
<form method="post" class="form">
  <div class="form-group">
    <label for="username">Username:</label>
    <input type="text" class="form-control" id="username" name="username">
  </div>
  <div class="form-group">
    <label for="pwd">Mật khẩu:</label>
    <input type="password" class="form-control" id="pwd" name="pwd">
  </div>
  <input type="submit" class="btn btn-primary" value="Đăng nhập" name="login">
  <p>Bạn chưa có tài khoản? Hãy <a href="signup.php">Đăng ký</a></p>
  	
</form>
</div>

</div>
</body>
</html>