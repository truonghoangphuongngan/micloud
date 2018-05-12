<?php
include_once("functions.php");
	//echo insert_comment(1,1,'tét');
  if(isset($_POST['insert-comment'])) 
  {
    $idPost = isset($_POST['idPost']) ? $_POST['idPost'] : null;
    $comment = isset($_POST['comment']) ? $_POST['comment'] : null;
    $idUser = isset($_POST['idUser']) ? $_POST['idUser'] : null;
    echo insert_comment($idPost,$idUser,$comment) ? 'sucess' :'fail';
    exit();
  }
?>