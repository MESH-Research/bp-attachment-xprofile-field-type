<?php
/**
 * BP Attachment for XProfile.
 *
 * @package BP_Attachment_XProfile_Field_Type
 */

/**
 * BP Attachment class for XProfile.
 */
class BP_Attachment_XProfile extends BP_Attachment {

	/**
	 * @var string The upload action used when uploading a file, $_POST['action'] must be set.
	 */
	const ACTION = 'bp_attachment_xprofile_upload';

	/**
	 * @var string The name attribute used in the file input.
	 */
	const FILE_INPUT = 'bp-attachment-xprofile-file';

	/**
	 * @var string Component's upload base directory.
	 */
	const BASE_DIR = 'bp-attachment-xprofile';

	/**
	 * Constuctor.
	 */
	public function __construct() {
		parent::__construct( [
			'action' => self::ACTION,
			'file_input' => self::FILE_INPUT,
			'base_dir' => self::BASE_DIR,
		] );
	}
}
