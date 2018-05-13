<?php
/**
 * connect database
 */
include_once( "database-connect.php" );

//Ham LOGIN
function sign_in( $username, $password ) {
// Gọi tới biến toàn cục $conn
	global $conn;

	// Hàm kết nối
	connect_db();
	//Khai báo sử dụng session
	@session_start();

	//Kiểm tra tên đăng nhập có tồn tại không
	$query = mysqli_query( $conn, "SELECT * FROM users WHERE users.username='$username'" );
	if ( mysqli_num_rows( $query ) == 0 ) {

		header( "Location: thong_bao/email_dang_nhap_khong_ton_tai" );
		exit;
	}

	//Lấy mật khẩu trong database ra
	$row = mysqli_fetch_array( $query, MYSQLI_BOTH );
	//So sánh 2 mật khẩu có trùng khớp hay không
	if ( $password != $row['userpass'] ) {

		header( "Location: thong_bao/sai_mat_khau" );
		exit;
	}
	//Lưu tên đăng nhập
	$_SESSION['username'] = $row['username'];
	$_SESSION['role']     = $row['role'];
	$_SESSION['userID']   = $row['userID'];

	if ( $row['role'] == 'admin' ) {

		header( "Location: thong_bao/xin_chao_admin" );
	} else {

		header( "Location: user.php" );
	}

	die();
}

//hàm search user
function search_user( $search ) {
	global $conn;

	// Hàm kết nối
	connect_db();

	//Khai báo sử dụng session
	//@session_start();

	//Kiểm tra tên đăng nhập có tồn tại không
	$query = mysqli_query( $conn, "SELECT * FROM `users`
        WHERE users.username like '%$search%' or users.email like '%$search%'" );

	// New khong tim thay
	if ( mysqli_num_rows( $query ) == 0 ) {

		mi_print( "Khong tim thay!" );

		return false;
	}

	// Tim thay
	if ( $query ) {

		$kq = '';

		if ( mysqli_num_rows( $query ) != 0 ) {
			while ( $row = mysqli_fetch_assoc( $query ) ) {

				$_SESSION['search_username'] = $row['username'];
				$_SESSION['search_userID']   = $row['userID'];

				$kq .= '<div class="card bg-primary"><div class="card-body">';
				$kq .= '<a href="' . get_link_user( $row['username'] ) . '" class="text-white">' . $row['username'] . '</a>';
				$kq .= '</div></div>';
			}
		}

		return $kq;

	} else {

		mi_print( "Loi khong xac dinh!" );
		exit;
	}
}


// Hàm thêm USER
function add_user( $username, $userpass, $fullname, $email, $gender, $role, $avatar ) {
	// Gọi tới biến toàn cục $conn
	global $conn;

	// Hàm kết nối
	connect_db();

	// Chống SQL Injection
	$username = addslashes( ucwords( $username ) ); // upper case each words
	$userpass = addslashes( $userpass );
	$fullname = addslashes( $fullname );
	$email    = addslashes( $email );
	$gender   = addslashes( $gender );
	$role     = addslashes( $role );
	$avatar   = addslashes( $avatar );

	// Kiểm tra username nay co nguoi dung chua
	if ( mysqli_num_rows( mysqli_query( $conn, "SELECT username FROM users WHERE username='$username'" ) ) > 0 ) {
		echo "thong_baoa_/username_da_su_dung";
		exit;
	}
	if ( mysqli_num_rows( mysqli_query( $conn, "SELECT email FROM users WHERE email='$email'" ) ) > 0 ) {
		echo "thong_baoa_/email_da_su_dung";
		exit;
	}

	// Câu truy vấn thêm
	$sql = "
            INSERT INTO users(username, userpass, fullname, email, gender, role, avatar) VALUES
            				('$username', '$userpass', '$fullname', '$email', '$gender', '$role', '$avatar')
    ";

	// Thực hiện câu truy vấn
	$query = mysqli_query( $conn, $sql );
	if ( $query ) {
		header( "Location: login.php" );
		exit;
	}

	header( "Location: thong_bao/dang_ky_khong_thanh_cong" );
	exit;
	die( "Unable to execute function add_user()!" ); // Print a message and exit the current script
}

// hàm lấy nội dung bài post
function get_content( $command, $quantity ) {
	global $conn;
	connect_db();
	switch ( $command ) {

		case 'postuser':
			$query = mysqli_query( $conn, "SELECT * FROM `posts` WHERE posts.userID = $quantity" );
			break;

		case 'userbyID':
			$query = mysqli_query( $conn, "SELECT * FROM `users` WHERE users.userID = $quantity" );
			break;

		case 'user_by_username':
			$query = mysqli_query( $conn, "SELECT * FROM `users` WHERE users.username = '$quantity'" );
			break;

		case 'search_user':
			$query = mysqli_query( $conn, "SELECT * FROM `users` 
            WHERE users.username like '%$quantity%' or users.email like '%$quantity%' " );
			break;

		case 'post_user_following':
			$query = mysqli_query( $conn, "SELECT * FROM `posts` WHERE userID IN ($quantity) ORDER BY created DESC" );
			break;

		case "comments":
			$query = mysqli_query( $conn, "SELECT * FROM `comments` WHERE comments.postID = '$quantity' ORDER BY created ASC" );
			break;

		case "post_like":
			$query = mysqli_query( $conn, "SELECT post_like FROM `users` WHERE users.userID = '$quantity'" );
			break;

		case "count_like":
			$query = mysqli_query( $conn, "SELECT count_like FROM `posts` WHERE posts.postID = '$quantity'" );
			break;

		default:
			echo "Wrong input! Command {$command} is not exist!";
	}

	$result = array();
	if ( $query ) {
		if ( mysqli_num_rows( $query ) != 0 ) {
			while ( $row = mysqli_fetch_assoc( $query ) ) {
				$result[] = $row;
			}
		}
	} else {
		die( "error " . $command );
	}

	return $result;
}

// Hàm xóa
function delete_content( $table, $column, $id ) {
	global $conn;
	connect_db();

	$query = mysqli_query( $conn, "DELETE FROM `$table` WHERE $table.$column = $id" );

	return $query;
}

function mi_print( $value ) {
	echo "<pre>";
	print_r( $value );
	echo "</pre>";
}

//ham lay avatar
function get_link_avatar( $userID = null ) {

	// Neu khong nhap Id thi lay cua user dang dang nhap
	if ( ! isset( $userID ) ) {
		$userID = $_SESSION['userID'];
	}

	// Get user data
	$user = get_content( 'userbyID', $userID );

	$avatar = $user[0]['avatar'];

	return get_link_photo( $avatar );
}

function get_link_photo( $photo_name ) {
	return "images/upload/" . $photo_name;
}

//update thông tin user
function update_user( $userID, $fullname, $email, $userpass ) {
	// Gọi tới biến toàn cục $conn
	global $conn;

	// Hàm kết nối
	connect_db();

	// Chống SQL Injection
	$fullname = addslashes( ucwords( $fullname ) ); // upper case each words
	$email    = addslashes( $email );
	$userpass = addslashes( $userpass );

	// Câu truy vấn thêm
	$sql = "
            UPDATE users SET fullname = '$fullname', email = '$email', userpass = $userpass WHERE users.userID = '$userID'
    ";

	// Thực hiện câu truy vấn
	$query = mysqli_query( $conn, $sql );
	if ( $query ) {

		header( "location:user.php" );
		exit;
	} else {

		echo "loi";
	}
	die( "Unable to execute function update_user()!" ); // Print a message and exit the current script
}

//update avatar
function update_avatar( $userID, $avatar ) {
	// Gọi tới biến toàn cục $conn
	global $conn;

	// Hàm kết nối
	connect_db();

	// Chống SQL Injection
	$avatar = addslashes( $avatar );


	// Câu truy vấn thêm
	$sql = "
            UPDATE users SET avatar = '$avatar' WHERE users.userID = '$userID'
    ";

	// Thực hiện câu truy vấn
	$query = mysqli_query( $conn, $sql );
	if ( $query ) {

		header( "location:user.php" );
		exit;
	} else {

		echo "loi";
	}
	die( "Unable to execute function update_avatar()!" ); // Print a message and exit the current script
}

// Hàm post bài mới
function new_post( $description, $tags, $photo, $userID ) {
	// Gọi tới biến toàn cục $conn
	global $conn;

	// Hàm kết nối
	connect_db();

	// Chống SQL Injection
	$description = addslashes( $description );
	$tags        = addslashes( $tags );


	// Câu truy vấn thêm
	$sql = "
            INSERT INTO posts(description, tags, photo, userID, count_like) VALUES
            				('$description', '$tags', '$photo', $userID, 0)
    ";

	// Thực hiện câu truy vấn
	$query = mysqli_query( $conn, $sql );
	if ( $query ) {

		header( "location:user.php" );
		exit;
	} else {

		echo "loi";
	}
	die( "Unable to execute function new_posst!" ); // Print a message and exit the current script
}

// delete post
function delete_post( $post_id ) {
	return delete_content( "posts", "postID", $post_id );
}

// Hàm upload hình
function upload_img() {
	// lấy tên file upload
	date_default_timezone_set( 'Asia/Ho_Chi_Minh' );
	$time  = date( "Ymd_His" );
	$image = $_FILES['photo']['name'];

	// Lấy tên gốc của file
	$filename = stripslashes( $_FILES['photo']['name'] );
	$filetype = $_FILES['photo']['type'];
	$file_tmp = $_FILES['photo']['tmp_name'];

	//Lấy phần mở rộng của file
	// $explore = explode ('.',$filename); //chia chuoi bang '.'
	//$ext = end($explore);
	//kiểm tra file phải hình ảnh ko
	$chophep = array( 'jpeg', 'png', 'bpm', 'jpg', 'JPEG', 'JPG' );

	/*----------UPLOADING----------*/
	// đặt tên mới cho file hình up lên
	$image_name = $filename;

	// gán thêm cho file này đường dẫn
	$newname = $_SERVER["DOCUMENT_ROOT"] . '/micloud/images/upload/' . $image_name;

	//nếu ko có lỗi xảy ra->> tiếp tục upload
	if ( move_uploaded_file( $file_tmp, $newname ) ) {

		$unitType->image = $image_name;
	}

	return $image;

}

//ham theo dõi bạn bè
function follow_friend( $username_follow ) {
	global $conn;
	connect_db();

	// Lay danh sach follow cua user
	$my_username = $_SESSION['username'];
	$query       = mysqli_query( $conn, "SELECT `follow` FROM `users` WHERE users.username = '$my_username'" );

	// Danh sach nguoi ma minh follow
	$result_string = '';

	// Neu co du lieu tra ve
	if ( $query ) {
		if ( mysqli_num_rows( $query ) != 0 ) {
			$result = mysqli_fetch_assoc( $query )['follow'];
		}
	}

	// Tach chuoi follow thanh mang
	$result_array = explode( ",", $result_string );

	// Loop de so sanh xem follow hay chua ---------------------- CHUA XONG
	foreach ( $result_array as $user_name ) {

		// If $user_name = $username_follow => minh follow roi => thoat ham
		if ( $user_name == $username_follow ) {
			mi_print( $user_name . ' == ' . $username_follow );

			return;
		}
	}

	// Them follow
	$result_string .= $username_follow . ',';

	// Save follow
	$sql = "UPDATE users SET follow = '$result_string' WHERE users.username = '$my_username'";

	// Thực hiện câu truy vấn
	$query = mysqli_query( $conn, $sql );

	if ( $query ) {
		mi_print( "Follow thanh cong" );
	} else {
		mi_print( "Follow that bai" );
	}
}

/* bebe */
function stringToArray( $string ) {
	// ví dụ $string = "be,mi,nguyen"
	return explode( ',', $string );
}

function arrayToString( $array ) {
	$str = "";
	foreach ( $array as $value ) {
		if ( ! empty( $value ) ) {
			$str .= $value . ",";
		}
	}

	return $str;
}

// hàm lấy tất cả các bài post của user mình theo dõi
function get_post_following( $userID ) {
	global $conn;
	connect_db();
	$query  = mysqli_query( $conn, "SELECT `follow` FROM `users` WHERE users.userID = $userID" );
	$result = array();
	if ( $query ) {
		if ( mysqli_num_rows( $query ) != 0 ) {
			$result = mysqli_fetch_assoc( $query );
		}
	}
	$listFriend = $result['follow'];

	return get_content( "post_user_following", $listFriend );
}

// hàm insert comment vào 1 bài post
function insert_comment( $idPost, $idUser, $comment ) {
	global $conn;
	connect_db();

	// Câu truy vấn thêm
	$sql = "
            INSERT INTO `comments`( `created`, `content`, `postID`, `userID`) VALUES (NOW(),'$comment','$idPost','$idUser')
    ";

	// Thực hiện câu truy vấn
	$query = mysqli_query( $conn, $sql );

	return ( $query );
}

// Hàm lấy comment thuộc post_id
function get_comment_by_post_id( $post_id ) {
	return get_content( "comments", $post_id );
}

// Hàm thêm like
function update_like( $post_like, $user_id ) {
	global $conn;
	connect_db();

	$sql = "UPDATE users SET post_like = '$post_like' WHERE users.userID = '$user_id'";

	// Thực hiện câu truy vấn
	$query = mysqli_query( $conn, $sql );

	return $query;
}

// Hàm xử lý like
function action_like( $post_id, $user_id ) {
	// get post_like array of user
	$post_like = get_content( 'post_like', $user_id )[0]['post_like'];

	// If post_like empty => insert
	if ( empty( $post_like ) ) {

		//mi_print( "liked the first time" );

		update_post_count_like( $post_id, 1 );

		return update_like( $post_id, $user_id );
	}

	$post_like = explode( ',', $post_like );

	// if user has liked this post => unlike
	if ( in_array( $post_id, $post_like ) ) {
		$new_post_like = '';
		foreach ( $post_like as $post ) {
			if ( $post != $post_id && ! empty( $post ) ) {
				$new_post_like .= $post . ',';
			}
		}

		//mi_print( "unliked" );
		update_post_count_like( $post_id, - 1 );

		return update_like( $new_post_like, $user_id );
	} // else => like
	else {
		global $conn;
		connect_db();

		//mi_print( $post_like );
		array_push( $post_like, $post_id );
		$post_like = arrayToString( $post_like );

		//mi_print( "liked" );
		update_post_count_like( $post_id, 1 );

		return update_like( $post_like, $user_id );
	}
}

// Hàm kiểm tra đã like hay chưa
function is_liked( $post_id, $user_id ) {
	// get post_like array of user
	$post_like = get_content( 'post_like', $user_id )[0]['post_like'];

	// If post_like empty => insert
	if ( empty( $post_like ) ) {
		return false;
	}

	$post_like = explode( ',', $post_like );

	// if user has liked this post => unlike
	if ( in_array( $post_id, $post_like ) ) {
		return true;
	} // else => like
	else {
		return false;
	}
}

// Lấy tổng like của post
function get_count_like( $post_id ) {
	$count_like = get_content( "count_like", $post_id )[0]['count_like'];

	if ( empty( $count_like ) ) {
		return "Hãy là người đầu tiên thích bài đăng này";
	}

	return $count_like . ' lượt thích';
}

// Update post count like
function update_post_count_like( $post_id, $index ) {
	global $conn;
	connect_db();

	$sql = "UPDATE posts SET count_like = count_like + '$index' WHERE postID = '$post_id'";

	// Thực hiện câu truy vấn
	$query = mysqli_query( $conn, $sql );

	return $query;
}

// Hàm lấy header
function get_header() {
	echo file_get_contents( "header.php" );
}

function get_footer() {
	echo file_get_contents( "footer.php" );
}

function get_link_user( $username ) {
	return "/micloud/user.php?username=" . $username;
}


