<?php
SESSION_START();
include_once("functions.php");


?>

<?php get_header();?>

<?php
if (!empty($_GET['search'])) {
	//Lấy dữ liệu nhập vào
	$data = $_GET['search'];

	//search user
    $kq = search_user( $data );
	if($kq != false){
	    echo $kq;
    } else {
	    echo "Khong tim thay!";
    }
}
?>


<?php get_footer();?>