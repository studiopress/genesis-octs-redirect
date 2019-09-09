<?php
/**
 * Plugin Name: Genesis One-Click Theme Setup Redirector
 * Plugin Description: Redirects users to the Genesis OCTS page the first time they log into wp-admin after using the Site Templates feature in Portal.
 */
namespace wpengine\genesis\octs_redirect;

defined( 'WPINC' ) or die;

add_action( 'admin_init', __NAMESPACE__ . '\load' );
/**
 * Loads up the plugin to handle the redirect
 * and then uninstalls itself.
 */
function load() {

	if ( wp_doing_ajax() ) {
		return;
	}

	/** A compatible theme not active. Stop now and remove the plugin. */
	if ( ! function_exists( 'genesis_onboarding_active' ) || ! genesis_onboarding_active() ) {
		schedule_plugin_for_removal();
		return;
	}

	/** The redirect has already happened. Stop now and remove the plugin. */
	if ( get_option( 'genesis_octs_redirect_complete', false ) ) {
		schedule_plugin_for_removal();
		return;
	}

	add_option( 'genesis_octs_redirect_complete', true );

	schedule_plugin_for_removal();

	wp_safe_redirect( esc_url( admin_url( 'admin.php?page=genesis-getting-started' ) ) );
	exit;
}

function schedule_plugin_for_removal() {
	add_action( 'shutdown', function() {
		delete_plugins( [ plugin_basename(__FILE__) ] );
	} );
}