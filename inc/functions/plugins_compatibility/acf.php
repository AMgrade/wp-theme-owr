<?php

/**
 * Add ACF PRO OPTION PAGE
 */
if (current_user_can('administrator')) {
    if(function_exists('acf_add_options_page')) {
        acf_add_options_page();
    }
}