<?php 
SESSION_START();
include_once("functions.php");


// Nếu người dùng submit form
if (!empty($_POST['new_post']))
{
    // Lay data
    $data['photo'] = upload_img();
    if($data['photo'] == 'fail') {echo "upload image fail";}
    $data['description'] = $_POST['description'];
    $data['tags'] = $_POST['tags'];
    $userID = $_SESSION['userID'];
   

    // Neu ko co loi thi insert
    new_post($data['description'] ,$data['tags'] ,$data['photo'], $userID);
   // Trở về trang user
   header("location: users.php");
}
disconnect_db();
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

<?php get_header();?>
<br>


<form class="form-horizontal" method="post" enctype = "multipart/form-data">
	<!-- Mô tả -->
  <div class="form-group">
    <label class="control-label col-sm-2" for="description"></label>
    <div class="col-sm-8">
      <textarea class="form-control" id="description" name="description" rows="5" placeholder="Cập nhật trạng thái..." maxlength="1000" required></textarea>
    </div>
  </div>
  <!-- Hagtag -->
  <div class="form-group">
    <label class="control-label col-sm-2" for="tags">Hagtag:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="tags" name="tags" placeholder="Điền từ khóa (Vd: Balo Mikkor, Mikkor black, Mikkor siêu rẻ, Mikkor chính hãng" maxlength="100" required>
    </div>
  </div>
  <!-- HÌNH ẢNH -->
  <div class="form-group">
    <label class="control-label col-sm-2" for="photo">Chọn hình</label>
    <div class="col-sm-8">
      <input type="file" class="form-control btn btn-default" id="photo" name="photo">
    </div>
  </div>
 
<!-- SUBMIT -->
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" class="btn btn-outline-danger" value="Đăng" name="new_post">
    </div>
  </div>
</form>

</body>
</html>