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

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- my css -->
    <link rel='stylesheet' type='text/css' href='css/micloud.css'>

    <!-- icon -->
    <link rel="shortcut icon" href="images/cloud.png">   

</head>

<body id="login">
<div class="container">

<!-- CONTENT -->



<div class="container mt-3">
  <div class="d-flex justify-content-around mb-3 ">

    <div class="p-2 alert-danger ">


      <div class="container ">


      <div  style="text-align:center">
      <img src="images/cloud4.png" style="width:60%">
      </div>

      <div>
      <div class="well">Cùng đăng ký tài khoản nhé !!!</div>
      <br>
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
            <label for="fullname">Tên đầy đủ:</label>
            <input type="text" class="form-control" id="fullname" name="fullname" required>
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required pattern="[a-zA-Z]{3,}@[a-zA-Z]{3,}[.]{1}[a-zA-Z]{3,}" title="Vui lòng nhập email có dạng:example@example.com" >
          </div>
          <div class="form-group">
            <label for="gender">Giới tính:</label>
            <input type="radio" name="gender" value="male" checked> Nam
            <input type="radio" name="gender" value="female"> Nữ <br>
          </div>
  
          <input type="submit" class="btn btn-outline-danger" name="logup" value="Đăng ký">
          <p>Bạn có tài khoản rồi? Hãy <a href="login.php" class="text-danger font-italic"><strong>Đăng nhập</strong></a></p>
          
      </form>
      </div>


      </div>      


    </div>
    
  </div>
</div>



</body>