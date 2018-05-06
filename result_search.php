<?php
SESSION_START();
include_once("functions.php");
include_once("link-ref.php");

if (!empty($_POST['submit_search']))
{
	//Lấy dữ liệu nhập vào
	$data['search'] = $_POST['search'];

	//search user
   $result =  get_content('search_user',$data['search']);   
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
<?php 
  foreach($result as $r){
        $html='';
        $username = $r['username'];
        $userID = $r['userID']; 
        $html .= '<a href="friend.php?userID='.$userID.'">'.$username.'</a></br>';
        echo $html;
  }
?>
    
</body>
</html>