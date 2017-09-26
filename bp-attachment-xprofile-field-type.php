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
 * Register the BP Attachment field type.
 *
 * @param array $field_types Key/value pairs (field type => class name).
 * @return array $field_types
 */
function bpaxft_filter_xprofile_get_field_types( array $field_types ) {
	require_once BPAXFT_PLUGIN_PATH . 'classes/class-bp-attachment-xprofile-field-type.php';

	return array_merge( $field_types, [
		'bp_attachment' => 'BP_Attachment_XProfile_Field_Type',
	] );
}
add_filter( 'bp_xprofile_get_field_types', 'bpaxft_filter_xprofile_get_field_types' );
