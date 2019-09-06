<?php
/**
 * Genesis OCTS Redirect Uninstaller.
 */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	return;
}

deactivate_plugins( [ 'genesis-octs-redirect/genesis-octs-redirect.php' ], true );

delete_option( 'genesis_octs_redirect_complete' );
