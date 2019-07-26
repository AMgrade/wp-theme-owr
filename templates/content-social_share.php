<?php

$current_share_url   = urlencode(get_permalink());
$current_share_title = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');

?>

<li class="share-buttons__facebook">
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $current_share_url; ?>">
        <img src="/wp-content/themes/owr/assets/img/fb-red.svg" alt="">
    </a>
</li>
<li class="share-buttons__twitter">
    <a href="https://twitter.com/intent/tweet?text=<?php echo $current_share_title; ?>&amp;url=<?php echo $current_share_url; ?>&amp;via=openworldrelief">
        <img src="/wp-content/themes/owr/assets/img/tw-red.svg" alt="">
    </a>
</li>
<!--<li class="share-buttons__instagram">
    <a href="">
        <img src="/wp-content/themes/owr/assets/img/share_instagram.svg" alt="">
    </a>
</li>-->