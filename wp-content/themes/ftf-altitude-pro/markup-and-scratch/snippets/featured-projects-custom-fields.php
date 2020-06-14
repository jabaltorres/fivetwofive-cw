<?php

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5b78c757949e2',
		'title' => 'Featured Projects',
		'fields' => array(
			array(
				'key' => 'field_5b78c76066f15',
				'label' => 'Project Title',
				'name' => 'project_title',
				'type' => 'text',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => 'add title here',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5b78c97cf09fd',
				'label' => 'Project URL',
				'name' => 'project_url',
				'type' => 'url',
				'instructions' => 'Add project url',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_5b78ca549e71b',
				'label' => 'Project Button Text',
				'name' => 'project_button_text',
				'type' => 'text',
				'instructions' => 'Add project button text',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'View Project',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5c41922c64e3b',
				'label' => 'Homepage toggle',
				'name' => 'homepage_toggle',
				'type' => 'true_false',
				'instructions' => 'Choose if image is going to be on the left',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => 'The True / False field allows you to select a value that is either 1 or 0.',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'featured-projects',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

endif;