<?php
/**
 * Rewrite rule for Add Campaign posts page
 */
add_action('generate_rewrite_rules', 'campaign_rule');
function campaign_rule($wp_rewrite) {
    $newrules = array();
    $new_rules['^my-account/campaigns/campaigns-add$'] = 'index.php?acp=true';
    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}

add_action( 'query_vars', 'campaign_query_vars' );
function campaign_query_vars( $query_vars ) {
    $query_vars[] = 'acp';
    return $query_vars;
}

add_action( 'parse_request', 'campaign_parse_request' );
function campaign_parse_request( &$wp )
{
    if ( array_key_exists( 'acp', $wp->query_vars ) ) {
        include( __DIR__ . '/templates/campaigns-add.php' );
        exit();
    }
}

/**
 * Rewrite rule for Edit Campaign posts page
 */
add_action('generate_rewrite_rules', 'campaign_rule_edit');
function campaign_rule_edit($wp_rewrite) {
    $newrules = array();
    $new_rules['^my-account/campaigns/campaigns-edit$'] = 'index.php?ecp=true';
    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}

add_action( 'query_vars', 'campaign_query_vars_edit' );
function campaign_query_vars_edit( $query_vars ) {
    $query_vars[] = 'ecp';
    return $query_vars;
}

add_action( 'parse_request', 'campaign_parse_request_edit' );
function campaign_parse_request_edit( &$wp )
{
    if ( array_key_exists( 'ecp', $wp->query_vars ) ) {

        include( __DIR__ . '/templates/campaigns-edit.php' );
        exit();
    }
}