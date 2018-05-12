<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Mi cloud</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  
  <!-- Comments content -->
  <div class="media border p-3" id="idPostContent">
  	<!-- Owers description -->
    <img src="images/user.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:40px;">
    <div class="media-body">
      <h4>Mi <small><i>Posted on February 19, 2016</i></small></h4>
      <p>Hôm nay trời nắng nắng ương ương tình đơn phương</p>
      <!-- Orther comment-->
      <div class="media p-3">
        <img src="images/user.png" alt="User" class="mr-3 mt-3 rounded-circle" style="width:45px;">
        <div class="media-body">
          <h4>Phúc <small><i>Posted on February 20 2016</i></small></h4>
          <p>Như khùng</p>
        
        </div>
      </div>  
      <div class="media p-3">
      	<img src="images/user.png" alt="" class="mr-3 mt-3 rounded-circle" style="width:45px; ">
      	<div class="media-body">
      		<h4>Như <small><i> </i>Posted on February 20 2016</small></h4>
      		<p>Ai nhắc gì tao</p>
      	</div>
      </div>
       <!-- End orther comment -->
      <form action="" method="POST" name="request-Comment" id="1">
      <div class="form-group media p-3">
		  	<input type="text" id="comment" placeholder="write comment" class="form-control">
		  	<button id= "insertItem" type="submit" class="btn btn-outline-info">Post</button>
		</div>
	</form>
     <!-- End of form post comment-->
    </div>
  </div>
</div>

</body>
</html>

<script type="text/javascript">
	 // submit insert defect
     $('#insertItem').on('click', function() {
      var $idPostContent = $(this).parent().parent().parent().attr('id');
      var $idPost = $(this).parent().parent('form').attr('id'); // id bài viết gắn vào form
      var $commentValue = $('#comment').val(); //nội dung bình luận
      var $idUser = '1'; // chưa get id user
        alert('as');
         // insert defect header
           $.ajax({
                dataType: "html",
                method: "POST",
                url:"process.php",
                evalScripts: true,
                data: ({
                  'insert-comment':'',
                  'idUser':$idUser,
                  'comment':$commentValue,
                  'idPost':$idPost
                }),
                success: function (data, textStatus) {
                  alert(data);
                  add_comment($idPostContent,$commentValue);
                  // hiện dòng cmt mới nhập
                }
            });
     });
function add_comment($idPostContent,$value){
    html = '<div class="media p-3">';
    html += '<img src="images/user.png" alt="" class="mr-3 mt-3 rounded-circle" style="width:45px; ">';
    html +='    <div class="media-body">';
    html +='       <h4>Username <small><i> </i>Posted on February 20 2016</small></h4>';
    html +='      <p>'+$value+'</p>';
    html +=' </div></div>';
    $idPostContent.append(html);
}

</script>