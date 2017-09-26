<?php

class BP_Attachment_XProfile_Field_Type extends BP_XProfile_Field_Type {

	public $name = 'BP Attachment';

	public $accepts_null_value = true;

	public function __construct() {
		parent::__construct();
	}

	public static function display_filter( $field_value, $field_id = '' ) {
		echo 'bp att df';
	}

	public function edit_field_html( array $raw_properties = [] ) {
		echo self::display_filter();
	}

	public function admin_field_html( array $raw_properties = [] ) {
		echo 'This field is not editable.';
	}

}
