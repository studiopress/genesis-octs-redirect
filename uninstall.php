<?php
/**
 * Genesis OCTS Redirect Uninstaller.
 *
 * Deactivates the plugin and removes the option.
 */

namespace wpengine\genesis\octs_redirect;

/**
 * Return early if access directly or used
 * outside the uninstall process.
 */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	return;
}

deactivate_plugins( [ main_plugin_file_basename() ], true );

delete_option( 'genesis_octs_redirect_complete' );
