<?php
/**
 * connect database
 */
include_once("database-connect.php");

//Ham LOGIN
function sign_in($username, $password){    
// Gọi tới biến toàn cục $conn
    global $conn;
     
    // Hàm kết nối
    connect_db();
	//Khai báo sử dụng session
	@session_start();
		 
		//Kiểm tra tên đăng nhập có tồn tại không
		$query = mysqli_query($conn,"SELECT * FROM users WHERE users.username='$username'");
		if (mysqli_num_rows($query) == 0) {
			
			header("Location: thong_bao/email_dang_nhap_khong_ton_tai");
			exit;
		}
		 
		//Lấy mật khẩu trong database ra
		$row = mysqli_fetch_array($query,MYSQLI_BOTH);
		//So sánh 2 mật khẩu có trùng khớp hay không
		if ($password != $row['userpass']) {
			
			header("Location: thong_bao/sai_mat_khau");
			exit;
		}
		//Lưu tên đăng nhập
		$_SESSION['username'] = $row['username'];
		$_SESSION['role'] = $row['role'];
		$_SESSION['userID'] = $row['userID'];
		
		if ($row['role']=='admin') {
			
			header("Location: thong_bao/xin_chao_admin");
		} else {
			
			header("Location: user.php");
		}
		
		die();
}

//hàm search user
function search_user($search){
    global $conn;
     
    // Hàm kết nối
    connect_db();
	//Khai báo sử dụng session
	@session_start();
		 
		//Kiểm tra tên đăng nhập có tồn tại không
		$query = mysqli_query($conn,"SELECT * FROM `users`
        WHERE users.username like '%$search%' or users.email like '%$search%'");
		if (mysqli_num_rows($query) == 0) {
			
			header("Location: thong_bao/email_dang_nhap_khong_ton_tai");
			exit;
		}
		 
        if ($query){
            if (mysqli_num_rows($query) != 0){
                while ($row = mysqli_fetch_assoc($query))
                    { 
                        $_SESSION['search_username'] = $row['username'];
                        $_SESSION['search_userID'] = $row['userID'];
                    }
            }
        }
        else {die("error ".$command);header("Location: thong_bao/ko_xac_dinh_noi_dung");exit;}
}


// Hàm thêm USER
function add_user($username, $userpass, $fullname, $email, $gender, $role, $avatar)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Hàm kết nối
    connect_db();
	
    // Chống SQL Injection
	$username = addslashes(ucwords($username)); // upper case each words
	$userpass = addslashes($userpass);
	$fullname = addslashes($fullname);
	$email = addslashes($email);
	$gender = addslashes($gender);
    $role = addslashes($role);
    $avatar = addslashes($avatar);
    
	// Kiểm tra username nay co nguoi dung chua
    if ( mysqli_num_rows(mysqli_query($conn,"SELECT username FROM users WHERE username='$username'"))>0)
    {
		echo "thong_baoa_/username_da_su_dung";
        exit;
    }
    if ( mysqli_num_rows(mysqli_query($conn,"SELECT email FROM users WHERE email='$email'"))>0)
    {
		echo "thong_baoa_/email_da_su_dung";
        exit;
    }
	
    // Câu truy vấn thêm
    $sql = "
            INSERT INTO users(username, userpass, fullname, email, gender, role, avatar) VALUES
            				('$username', '$userpass', '$fullname', '$email', '$gender', '$role', '$avatar')
    ";
     
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
	if ($query){			
		header("Location: login.php"); exit;	
	}

	header("Location: thong_bao/dang_ky_khong_thanh_cong"); exit;
	die("Unable to execute function add_user()!"); // Print a message and exit the current script
}

 // hàm lấy nội dung bài post
function get_content($command,$quantity){
    global $conn;
    connect_db();
    switch($command) {
        case 'postuser':
        $query = mysqli_query($conn, "SELECT * FROM `posts` WHERE posts.userID = $quantity");
            break;

        case 'userbyID':
        $query = mysqli_query($conn, "SELECT * FROM `users` WHERE users.userID = $quantity");
            break;

        case 'search_user':
        $query = mysqli_query($conn, "SELECT * FROM `users` 
            WHERE users.username like '%$quantity%' or users.email like '%$quantity%' ");
        break;

        default:
			echo "Wrong input! Command {$command} is not exist!";
    }

    $result = array();
    if ($query){
		if (mysqli_num_rows($query) != 0){
			while ($row = mysqli_fetch_assoc($query))
				{ $result[] = $row; }
		}
    }
    else {die("error ".$command);header("Location: thong_bao/ko_xac_dinh_noi_dung");exit;}
    
    return $result;
}

function mi_print($value){
    echo "<pre>";
    print_r($value);
    echo "</pre>";
}

//ham lay avatar
function get_user_avatar($userID=null){
    // Neu khong nhap Id thi lay cua user dang dang nhap
    if(!isset($userID)){
        $userID = $_SESSION['userID'];
    }

    // Get user data
    $user = get_content('userbyID',$userID);
    $avatar = $user[0]['avatar'];

    echo $avatar;
}

//update thông tin user
function update_user($userID,$fullname, $email, $userpass)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Hàm kết nối
    connect_db();
     
    // Chống SQL Injection
	$fullname = addslashes(ucwords($fullname)); // upper case each words
	$email = addslashes($email);
	$userpass = addslashes($userpass);
	
    // Câu truy vấn thêm
    $sql = "
            UPDATE users SET fullname = '$fullname', email = '$email', userpass = $userpass WHERE users.userID = '$userID'
    ";
     
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
	if ($query){
	
        header("location:user.php"); exit;
	} else {
		
		echo "loi";
	}
	die("Unable to execute function update_user()!"); // Print a message and exit the current script
}

//update avatar
function  update_avatar($userID, $avatar){
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Hàm kết nối
    connect_db();
    
    // Chống SQL Injection
    $avatar = addslashes($avatar);
	
	
    // Câu truy vấn thêm
    $sql = "
            UPDATE users SET avatar = '$avatar' WHERE users.userID = '$userID'
    ";
     
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
	if ($query){
	
        header("location:user.php"); exit;
	} else {
		
		echo "loi";
	}
	die("Unable to execute function update_avatar()!"); // Print a message and exit the current script
}

// Hàm post bài mới
function new_post($description, $tags, $photo, $userID)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Hàm kết nối
    connect_db();
     
    // Chống SQL Injection
	$description = addslashes($description); 
    $tags = addslashes($tags);
   

	
    // Câu truy vấn thêm
    $sql = "
            INSERT INTO posts(description, tags, photo, userID) VALUES
            				('$description', '$tags', '$photo', $userID)
    ";
     
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
	if ($query){
		
        header("location:user.php"); exit;
	} else {
		
		echo "loi";
	}
	die("Unable to execute function new_posst!"); // Print a message and exit the current script
}

// Hàm upload hình

function upload_img(){
	// lấy tên file upload
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $time = date("Ymd_His");
    $image=$_FILES['photo']['name'];
    // Lấy tên gốc của file
    $filename = stripslashes($_FILES['photo']['name']);
    $filetype = $_FILES['photo']['type'];
    $file_tmp = $_FILES['photo']['tmp_name'];
    //Lấy phần mở rộng của file
   // $explore = explode ('.',$filename); //chia chuoi bang '.'
    //$ext = end($explore);
    //kiểm tra file phải hình ảnh ko
    $chophep = array('jpeg','png','bpm','jpg','JPEG','JPG');
   
    /*----------UPLOADING----------*/
    // đặt tên mới cho file hình up lên
    $image_name = $filename;
    // gán thêm cho file này đường dẫn
    $newname=$_SERVER["DOCUMENT_ROOT"]. '/micloud/images/upload/' .$image_name;
    //nếu ko có lỗi xảy ra->> tiếp tục upload
        if (move_uploaded_file($file_tmp,$newname)){
              
              $unitType->image=$image_name;
            }
            return $image;
    
}

//ham theo dõi bạn bè
function follow_friend($username_friend, $userID){
    global $conn;
    connect_db();
    $query = mysqli_query($conn, "SELECT `follow` FROM `users` WHERE users.userID = $userID");
    $result = array();
    if ($query){
		if (mysqli_num_rows($query) != 0){
            $result= mysqli_fetch_assoc($query);
        
        }   
    }
    
   
    if(empty($result['follow'])){
        $friend = $username_friend;
        echo 'Da them  ng dau tien';
        
    }else{

        $friend = $result['follow'];
        echo $friend;
       // neu co roi thif khong them nua, unfolow
        if(strpos($friend, $username_friend) > -1){
            
            echo strpos($friend, $username_friend);
            $friend .= ','.$username_friend;
            echo "follow";
            
            
        }else{
           echo 'unfollow';
        }  
    }
    
    $sql = "
            UPDATE users SET follow = '$friend' WHERE users.userID = '$userID'
    ";
    mysqli_query($conn, $sql);
}
?>
