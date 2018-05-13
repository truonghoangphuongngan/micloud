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
<body>


<!--fefefv-->

<div class="container mt-3">
  <div class="d-flex justify-content-around mb-3 ">

    <div class="p-2 alert-danger ">


      <div class="container ">


      <div  style="text-align:center">
      <img src="images/cloud4.png" style="width:60%">
      </div>

      <div>
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
        <input type="submit" class="btn btn-outline-danger" value="Đăng nhập" name="login">
        <p>Bạn chưa có tài khoản? Hãy <a href="signup.php" class="text-danger font-italic"><strong>Đăng ký</strong></a></p>
          
      </form>
      </div>


      </div>      


    </div>
    
  </div>
</div>





</body>
</html>