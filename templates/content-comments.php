<?php

$args = array(
    'no_found_rows' => true,
    'order' => 'DESC',
    'post_id' => $post->ID,
    'status' => 'all',
    'count' => false,
    'meta_key' => '',
    'meta_value' => '',
    'meta_query' => '',
    'date_query' => null,
    'hierarchical' => false,
    'update_comment_meta_cache' => true,
    'update_comment_post_cache' => false,
);

$author_id = get_the_author_meta('ID');
$author_image = get_field('profile_image', 'user_'. $author_id );

if ($comments = get_comments($args)) {
    foreach ($comments as $comment) { ?>
        <div class="product-section__title">
            Reviews
        </div>
        <div class="product-section__review-item">
            <div>
                <div class="review-item__author-info">
                    <div class="review-item__author-image">
                        <?php if ($author_image) { ?>
                        <img style="width: 82px; height: 82px; object-fit: cover" src="<?php echo $author_image['url']; ?>" alt="<?php echo $author_image['alt']; ?>" />
                        <?php } else {
                            echo get_avatar($comment, 82);
                        } ?>
                    </div>
                    <div class="review-item__name">
                        <span class="name">
                            <?php echo $comment->comment_author; ?>
                        </span>
                        <span class="date">
                            <?php echo date('F j, Y', strtotime($comment->comment_date)); ?>
                        </span>
                    </div>
                </div>
                <div class="review-item__rate">
                    <?php
                    if ($rating = get_comment_meta(get_comment_ID(), 'rating', true)) {
                        $stars = '<ul class="stars">';
                        for ($i = 1; $i <= $rating; $i++) {
                            $stars .= '<li class="dashicons dashicons-star-filled"></li>';
                        }
                        $stars .= '</ul>';
                        echo $stars;
                    }
                    ?>
                </div>
            </div>
            <div>
                <div class="review-item__content">
                    <?php echo $comment->comment_content; ?>
                </div>
            </div>
        </div>
    <?php }
}

?>
<div class="product-section__add-review">
    <?php
    //Comment forms args
    $defaults = array(
        'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8"  aria-required="true" required="required"></textarea></p>',
        'logged_in_as' => '',
        'title_reply' => __('Add review'),
        'title_reply_to' => __(''),
        'label_submit' => __('Submit'),
    );
    if (is_user_logged_in()) {
        comment_form($defaults);
    } ?>
</div>