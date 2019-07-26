<?php

//Create the rating interface.
add_action( 'comment_form_logged_in_after', 'ci_comment_rating_rating_field' );
add_action( 'comment_form_after_fields', 'ci_comment_rating_rating_field' );
function ci_comment_rating_rating_field () {
    ?>
    <fieldset class="comments-rating">
		<span class="rating-container">
			<?php for ( $i = 5; $i >= 1; $i-- ) : ?>
                <input type="radio" id="rating-<?php echo esc_attr( $i ); ?>" name="rating" value="<?php echo esc_attr( $i ); ?>" /><label for="rating-<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $i ); ?></label>
            <?php endfor; ?>
            <input type="radio" id="rating-0" class="star-cb-clear" name="rating" value="0" /><label for="rating-0">0</label>
		</span>
    </fieldset>
    <?php
}

//Save the rating submitted by the user.
add_action( 'comment_post', 'ci_comment_rating_save_comment_rating' );
function ci_comment_rating_save_comment_rating( $comment_id ) {
    if ( ( isset( $_POST['rating'] ) ) && ( '' !== $_POST['rating'] ) )
        $rating = intval( $_POST['rating'] );
    add_comment_meta( $comment_id, 'rating', $rating );
}

//Make the rating required.
add_filter( 'preprocess_comment', 'ci_comment_rating_require_rating' );
function ci_comment_rating_require_rating( $commentdata ) {
    if ( ! is_admin() && ( ! isset( $_POST['rating'] ) || 0 === intval( $_POST['rating'] ) ) )
        wp_die( __( 'Error: You did not add a rating. Hit the Back button on your Web browser and resubmit your comment with a rating.' ) );
    return $commentdata;
}