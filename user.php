<?php
SESSION_START();
include_once( "functions.php" );


/**
 * GET USER DATA
 */
// Neu ko lay duoc username
$username  = '';
$user_id   = 0;
$is_friend = false;
if ( ! isset( $_GET['username'] ) ) {

	// Tra ve trang ca nhan cua minh
	$username = $_SESSION['username'];
	$user_id  = $_SESSION['userID'];

} else {
	// tra ve trang cua username

	$is_friend = true;

    $username = $_GET['username'];

	$user_data = get_content( 'user_by_username', $username );

	$user_id = $user_data[0]['userID'];
}

$posts = get_content( 'postuser', $user_id );

/**
 * FOLLOW FUNCTION
 */
// Neu nhan duoc ten follow
if( isset( $_POST['follow'] )){
    $user_follow = $_POST['follow'];
	follow_friend($user_follow);
}

?>
<?php get_header(); ?>
    <!-- thông tin-->
    <div class="card-group">
        <!--avatar-->
        <div class="user_avatar">
            <a href="edituser.php">
                <div class="user_imgavatar"title="Thay đổi ảnh đại diện">
                    <img class="card-img-top rounded-circle" src="<?php echo get_link_avatar( $user_id ); ?>" alt="Card image">
                </div>
            </a>
        </div>
        <!-- Chinh sua thong tin -->
        <div class="user_info">
            <div><h2  class="text-danger"> <?php echo $username; ?></h2></div>
				<?php if ( ! $is_friend or $username == $_SESSION['username']): ?>
                    <div><a href="edituser.php" class="text-danger font-italic">Chỉnh sửa thông tin</a></div>
                    <br>
                    <div><a href="logout.php" class="btn btn-outline-danger ">Đăng Xuất</a></div>
				<?php endif; ?>

				<?php if ( $is_friend && $username != $_SESSION['username']): ?>
                    <form action="" method="post">
                        <input class="hidden" name="follow" value="<?php echo $username; ?>" />
                        <button type="submit" class="btn btn-outline-danger">Theo dõi</button>
                    </form>
				<?php endif; ?>
        </div>
    </div>
    <!--end thông tin-->

<?php if ( ! $is_friend or $username == $_SESSION['username']): ?>
            <div style="border-bottom: 2px solid pink; margin-bottom: 20px; padding:5px;" class="card-body text-center">            
                <a class="navbar-brand" href="newpost.php">
                    <p class="text-monospace text-danger">ĐĂNG BÀI</p>
                </a>
            </div>
<?php endif; ?>


    <!-- Danh sach post -->
    <div class="row">
		<?php foreach ( $posts as $post ): ?>

            <div class="col-lg-4 col-md-6 col-sm-12 post-item">
                <div class="photo-wrapper"
                     style="background-image: url(<?php echo get_link_photo( $post['photo'] ); ?>)"
                     data-toggle="modal" data-target="#post-<?php echo $post['postID']; ?>">
                    <img src="<?php echo get_link_photo( $post['photo'] ); ?>" alt="" class="post-photo"/>
                    <img src="img_avatar.png" alt="Avatar" class="image" style="width:100%">
                    <div class="overlay">
                        <a href="#" class="icon" title="User Profile">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- The Modal -->
            <div class="modal fade" id="post-<?php echo $post['postID']; ?>">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal body -->
                        <div class="modal-body">

                            <div class="row">

                                <!-- Photo -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <img src="<?php echo get_link_photo( $post['photo'] ); ?>" width="100%"/>
                                </div>

                                <!-- Caption -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="media border p-3">
                                        <img src="<?php echo get_link_avatar( $user_id ); ?>" class="mr-3 mt-3 rounded-circle" style="width:60px;">
                                        <div class="media-body">
                                        <h5><?php echo $username; ?></h5>
                                        <p><?php echo $post['description']; ?></p>      
                                        </div>
                                    </div>
                                    <div><i class="fa fa-heart-o fa-2x text-danger" aria-hidden="true"></i></div>
                                    <form>
                                        <div class="form-group">
                                        <textarea class="form-control" rows="2" id="comment" placeholder="Thêm bình luận ..."></textarea>
                                        </div>
                                    </form>

                                </div>

                            </div>

                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger"" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>

		<?php endforeach; ?>
    </div>
    <!-- END Danh sach post -->

<?php get_footer(); ?>