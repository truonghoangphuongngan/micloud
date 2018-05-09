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
        <div class="card bg-light text-dark">

            <div class="card-body text-center">
                <div class="card" style="width:30%" title="Thay đổi ảnh đại diện">
                    <img class="card-img-top" src="<?php echo get_link_avatar( $user_id ); ?>" alt="Card image">
                </div>
            </div>
        </div>
        <!-- end avatar-->

        <!-- Chinh sua thong tin -->
        <div class="card bg-light text-dark">
            <div class="card-body text-center">
                <div class="card-body">
                    <div><h2> <?php echo $username; ?></h2></div>
					<?php if ( ! $is_friend ): ?>
                        <div><a href="edituser.php">Chỉnh sửa thông tin</a></div>
                        <div><a href="logout.php" class="btn btn-outline-danger">Đăng Xuất</a></div>
					<?php endif; ?>

					<?php if ( $is_friend ): ?>
                        <form action="" method="post">
                            <input class="hidden" name="follow" value="<?php echo $username; ?>" />
                            <button type="submit" class="btn btn-outline-danger">Theo dõi</button>
                        </form>
					<?php endif; ?>
                </div>
            </div>
        </div>
        <!-- END Chinh sua thong tin -->

    </div>
    <!--end thông tin-->

<?php if ( ! $is_friend ): ?>
    <div class="card-group">
        <div class="card bg-light text-dark">
            <div class="card-body text-center">
                <div><a href="newpost.php">Đăng bài</a></div>
            </div>
        </div>
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
									<?php echo $post['description']; ?>
                                </div>

                            </div>

                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>

		<?php endforeach; ?>
    </div>
    <!-- END Danh sach post -->

<?php get_footer(); ?>