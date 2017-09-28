<?php
/**
 * Plugin Name:     BP Attachment XProfile Field Type
 * Plugin URI:      https://github.com/mlaa/bp-attachment-xprofile-field-type
 * Description:     Custom XProfile field type for BuddyPress Attachments.
 * Author:          MLA
 * Author URI:      https://github.com/mlaa
 * Text Domain:     bp-attachment-xprofile-field-type
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Bp_Attachment_Xprofile_Field_Type
 */

define( 'BPAXFT_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'BPAXFT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Register the BP Attachment XProfile field type.
 *
 * @param array $field_types Key/value pairs (field type => class name).
 * @return array $field_types
 */
function bpaxft_filter_xprofile_get_field_types( array $field_types ) {
	require_once BPAXFT_PLUGIN_PATH . 'classes/class-bp-attachment-xprofile.php';
	require_once BPAXFT_PLUGIN_PATH . 'classes/class-bp-attachment-xprofile-field-type.php';

	return array_merge(
		$field_types,
		[
			'bp_attachment' => 'BP_Attachment_XProfile_Field_Type',
		]
	);
}
add_filter( 'bp_xprofile_get_field_types', 'bpaxft_filter_xprofile_get_field_types' );

/**
 * Handle file uploads.
 */
function bpaxft_handle_uploaded_file() {
	if (
		isset( $_POST['action'] ) &&
		BP_Attachment_XProfile::ACTION === $_POST['action'] &&
		! empty( $_FILES[ BP_Attachment_XProfile::FILE_INPUT ]['name'] )
	) {
		$attachment = new BP_Attachment_XProfile();
		$file = $attachment->upload( $_FILES );

		if ( ! empty( $file['error'] ) ) {
			bp_core_add_message( $file['error'], 'error' );
		} else {
			// TODO This assumes the profile being edited belongs to the current user.
			// If e.g. an admin is editing another user's profile, this won't work.
			$result = xprofile_set_field_data(
				$_POST['bpaxft_field_id'],
				get_current_user_id(),
				$file['url']
			);

			// TODO If xprofile_set_field_data() failed, we should handle that here.

			// TODO Can this be more portable? Without this redirect, xprofile_set_field_data() doesn't take.
			// See https://codex.buddypress.org/plugindev/bp_attachment.
			bp_core_redirect( $_SERVER['REQUEST_URI'] );
		}
	}
}
add_action( 'init', 'bpaxft_handle_uploaded_file' );
