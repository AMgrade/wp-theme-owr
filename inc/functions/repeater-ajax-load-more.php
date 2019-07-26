<?php

/*
        this is an example of how to create a repeater that will show a specific number of rows
        and add a link (button) to display more rows

        this code would generally be added to your functions.php file

        Note: This will only work for a single repeater field. You will need to add different functions
        with different names to use this on multiple repeater field

        The code in this file should go into your function.php file
        or be included by your functions.php file

        Please note that this example uses jQuery to perform the AJAX request
        You must enqueue jQuery using a wp_enqueue_scripts action
*/

// add action for logged in users
add_action('wp_ajax_my_repeater_show_more', 'my_repeater_show_more');
// add action for non logged in users
add_action('wp_ajax_nopriv_my_repeater_show_more', 'my_repeater_show_more');

function my_repeater_show_more()
{
    // validate the nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'my_repeater_field_nonce')) {
        exit;
    }
    // make sure we have the other values
    if (!isset($_POST['post_id']) || !isset($_POST['offset'])) {
        return;
    }
    $show = 11; // how many more to show
    $start = $_POST['offset'];
    $end = $start + $show;
    $post_id = $_POST['post_id'];
    // use an object buffer to capture the html output
    // alternately you could create a varaible like $html
    // and add the content to this string, but I find
    // object buffers make the code easier to work with
    ob_start();
    if (have_rows('your_sponsors', $post_id)) {
        $total = count(get_field('your_sponsors', $post_id));
        $count = 0;
        while (have_rows('your_sponsors', $post_id)) {
            the_row();
            $sponsor_image    = get_sub_field('sponsors_image');
            $sponsors_title   = get_sub_field('sponsors_title');
            $sponsors_content = get_sub_field('sponsors_content');
            $sponsors_link    = get_sub_field('sponsor_link');
            if ($count < $start) {
                // we have not gotten to where
                // we need to start showing
                // increment count and continue
                $count++;
                continue;
            }
            ?>
            <div class="col-md-3">
                <a target="_blank" href="<?php echo $sponsors_link; ?>">
                    <div class="sponsors-item">
                        <div class="sponsors-item__image">
                            <img src="<?php echo $sponsor_image['url']; ?>" alt="<?php echo $sponsor_image['alt']; ?>">
                        </div>
                        <div class="sponsors-item__title">
                            <h4><?php echo $sponsors_title; ?></h4>
                        </div>
                        <div class="sponsors-item__content">
                            <p><?php echo $sponsors_content; ?></p>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            $count++;
            if ($count == $end) {
                // we've shown the number, break out of loop
                break;
            }
        } // end while have rows
    } // end if have rows
    $content = ob_get_clean();
    // check to see if we've shown the last item
    $more = false;
    if ($total > $count) {
        $more = true;
    }
    // output our 3 values as a json encoded array
    echo json_encode(array('content' => $content, 'more' => $more, 'offset' => $end));
    exit;
} // end function my_repeater_show_more