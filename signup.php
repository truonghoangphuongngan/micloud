<?php
SESSION_START();
include_once("functions.php");
// Nếu người dùng submit form, truy cập theo thuộc tính name trên thẻ html
if (!empty($_POST['logup']))
{
    // Lay data
    $data['username'] = $_POST['username'];
	$data['userpass'] = $_POST['userpass'];
    $data['fullname'] = $_POST['fullname'];
    $data['email'] = $_POST['email'];
    $data['gender'] = $_POST['gender'];
    $data['role'] = "user";
    $data['avatar'] = "default_avatar.jpg";
	

    // Neu ko co loi thi insert
    add_user($data['username'], $data['userpass'], $data['fullname'], $data['email'], $data['gender'], $data['role'], $data['avatar']);
    // Trở về trang danh sách
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

<body id="login">
<div class="container">

<!-- CONTENT -->
<div class="row login">

<div class="col-lg-6 col-sm-12" style="text-align:center">
<img src="images/icon.png">
</div>

<div class="col-lg-6 col-sm-12">
<div class="well">Đăng ký tài khoản</div>
<form class="form" method="post">
  <div class="form-group">
    <label for="username">Tên đăng nhập:</label>
    <input type="text" class="form-control" id="username" name="username" required min="10" max="20">
  </div>
  <div class="form-group">
    <label for="userpass">Mật khẩu:</label>
    <input type="password" class="form-control" id="userpass" name="userpass" required min="8" max="20">
  </div>
  <div class="form-group">
    <label for="fullname">Tên dầy đủ:</label>
    <input type="text" class="form-control" id="fullname" name="fullname" required>
  </div>
  <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <div class="form-group">
    <label for="gender">Giới tính:</label>
    <input type="radio" name="gender" value="male" checked> Nam
    <input type="radio" name="gender" value="female"> Nữ <br>
  </div>
  
  <input type="submit" class="btn btn-primary" name="logup" value="Đăng ký">
  <p>Bạn có tài khoản rồi? Hãy <a href="login.php">đăng nhập</a></p>
</form>
</div>

</div>
<!-- END CONTENT -->
</div>

</body>