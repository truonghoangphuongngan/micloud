<?php
SESSION_START();
include_once( "functions.php" );

get_header();
$posts = get_content( "all_posts" );

/**
 * Like function
 */
// Neu nhan duoc like
if ( isset( $_POST['post_like'] ) ) {
	action_like( $_POST['post_like'], $_SESSION['userID'] );
}

/**
 * Comment function
 */
// Neu nhan duoc comment
if ( isset( $_POST['comment'] ) ) {
	$comment = $_POST['comment'];
	insert_comment( $_POST['post_id'], $_SESSION['userID'], $comment );
}
?>
    <span class="hidden" id="home-page"></span>
    <div class="container bg-white margin-minus">
        <div class="container-850px mt-3">

			<?php foreach ( $posts as $post ):;
				$user = get_content( "userbyID", $post['userID'] )[0];
				?>

                <div class="media border p-3 mb-3 bg-grey">
                    <div class="avatar-display">
                        <img src="<?php echo get_link_avatar( $post['userID'] ); ?>" alt="John Doe">
                    </div>
                    <div class="media-body">
                        <h4><?php echo $user['fullname']; ?>
                            <small><i><?php echo $post['created']; ?></i></small>
                        </h4>
                        <p><?php echo $post['description']; ?></p>

                        <div class="home-post-photo">
                            <img src="<?php echo get_link_photo( $post['photo'] ); ?>">
                        </div>

                        <!-- Like -->
                        <section class="like-function">
		                    <?php
		                    $like_button   = '<i class="fa fa-heart-o fa-2x" aria-hidden="true" title="Like"></i>';
		                    $unlike_button = '<i class="fa fa-heart fa-2x" aria-hidden="true" title="Unlike"></i>';
		                    ?>
                            <form method="post" action="">
                                <button class="btn btn-link" type="submit"
                                        name="post_like" value="<?php echo $post['postID']; ?>">
				                    <?php echo is_liked( $post['postID'], $_SESSION['userID'] ) ? $unlike_button : $like_button; ?>
                                </button>
                                <span><?php echo get_count_like( $post['postID'] ); ?></span>
                            </form>
                        </section>

                        <!-- Comments -->
                        <section class="comments">
		                    <?php foreach ( get_comment_by_post_id( $post['postID'] ) as $comment ):; ?>
                                <div class="comment-line">
                                                <span class="comment-user"><img
                                                            src="<?php echo get_link_avatar( $comment['userID'] ); ?>"></span>
                                    <span class="comment-content"><?php echo $comment['content']; ?></span>
                                </div>
		                    <?php endforeach; ?>
                        </section>

                        <form method="post" action="">
                            <div class="form-group">
                                            <textarea minlength="20" class="form-control" rows="2" name="comment"
                                                      placeholder="Thêm bình luận ..."></textarea>
                                <input class="hidden" name="post_id" value="<?php echo $post['postID']; ?>">
                                <button type="submit" class="btn btn-primary">Gửi</button>
                            </div>
                        </form>

                    </div>
                </div>

			<?php endforeach; ?>

        </div>
    </div>

<?php get_footer(); ?>