<?php
/**
 * Uninstall the plugin.
 *
 * @package WPDiscourse
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

$discourse_options   = get_option( 'discourse_option_groups' );
$discourse_options[] = 'discourse_configurable_text_backup';
$discourse_options[] = 'discourse_version';
$discourse_options[] = 'discourse_option_groups';
$discourse_options[] = 'wpdc_discourse_domain';
$discourse_options[] = 'wpdiscourse_nonce_db_version';

foreach ( $discourse_options as $option ) {
	delete_option( $option );
	delete_site_option( $option );
}

delete_option( 'wpdc_discourse_categories' );

// Todo: loop through blogs to delete options for each.
delete_site_option( 'wpdc_multisite_configuration' );
delete_site_option( 'wpdc_site_options' );

global $wpdb;
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}discourse_nonce" );
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->base_prefix}wpdc_topic_blog" );

