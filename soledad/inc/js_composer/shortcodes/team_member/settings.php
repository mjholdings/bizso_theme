<?php
$group_color = 'Typo & Color';
$group_team  = 'Team Member';

vc_map( array(
	'base'          => 'penci_team_member',
	'icon'          => PENCI_SOLEDAD_URL . '/images/vc-icon.png',
	'category'      => penci_get_theme_name( 'Soledad' ),
	'html_template' => PENCI_SOLEDAD_DIR . '/inc/js_composer/shortcodes/team_member/frontend.php',
	'weight'        => 700,
	'name'          => penci_get_theme_name( 'Penci' ) . ' ' . esc_html__( 'Team Members', 'soledad' ),
	'description'   => __( 'Team Members Block', 'soledad' ),
	'controls'      => 'full',
	'params'        => array_merge( array(
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Design style', 'soledad' ),
			'param_name' => 'style',
			'std'        => 's1',
			'value'      => array(
				esc_html__( 'Bordered', 'soledad' )         => 's1',
				esc_html__( 'Background', 'soledad' )       => 's2',
				esc_html__( 'Extended', 'soledad' )         => 's3',
				esc_html__( 'Overlay Slide Up', 'soledad' ) => 's4',
			)
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Title Position', 'soledad' ),
			'param_name' => 'titpos',
			'std'        => 'default',
			'value'      => array(
				'Default'             => 'default',
				'Above Position Text' => 'above',
				'Below Position Text' => 'below',
			)
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Social Icons Shape', 'soledad' ),
			'param_name' => 'social_shape',
			'std'        => 'default',
			'value'      => array(
				'Default' => 'default',
				'Circle'  => 'circle',
				'Square'  => 'square',
				'Round'   => 'round',
			)
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Social Icons Style', 'soledad' ),
			'param_name' => 'social_style',
			'std'        => 'default',
			'value'      => array(
				'Default'  => 'default',
				'Filled'   => 'filled',
				'Bordered' => 'bordered',
			)
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Social Icons Colors Style', 'soledad' ),
			'param_name' => 'social_colors',
			'std'        => 'default',
			'value'      => array(
				'Custom Colors'     => 'default',
				'Brands Color'      => 'brandbg',
				'Brands Text Color' => 'brandtext',
			)
		),
		array(
			'type'       => 'dropdown',
			'heading'    => __( 'Columns', 'soledad' ),
			'param_name' => 'columns',
			'value'      => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
			),
			'std'        => '3'
		),
		array(
			'type'       => 'dropdown',
			'heading'    => __( 'Tablet Columns', 'soledad' ),
			'param_name' => 'columns_tablet',
			'value'      => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
			),
			'std'        => '3'
		),
		array(
			'type'       => 'dropdown',
			'heading'    => __( 'Mobile Columns', 'soledad' ),
			'param_name' => 'columns_mobile',
			'value'      => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
			),
			'std'        => '3'
		),
		array(
			'type'             => 'penci_only_number',
			'param_name'       => 'height_team',
			'heading'          => esc_html__( 'Set height team member', 'soledad' ),
			'value'            => '',
			'suffix'           => 'px',
			'min'              => 1,
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'             => 'penci_only_number',
			'param_name'       => 'border_width_team',
			'heading'          => esc_html__( 'Set border width team member', 'soledad' ),
			'value'            => '',
			'suffix'           => 'px',
			'min'              => 1,
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'             => 'penci_only_number',
			'param_name'       => 'width_img',
			'heading'          => esc_html__( 'Set width for Image', 'soledad' ),
			'value'            => '',
			'suffix'           => 'px',
			'min'              => 1,
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'             => 'penci_only_number',
			'param_name'       => 'height_img',
			'heading'          => esc_html__( 'Set height for Image', 'soledad' ),
			'value'            => '',
			'suffix'           => 'px',
			'min'              => 1,
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'             => 'penci_only_number',
			'param_name'       => 'row_gap',
			'heading'          => __( 'Rows Gap', 'soledad' ),
			'value'            => '',
			'std'              => '',
			'suffix'           => 'px',
			'min'              => 1,
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'             => 'penci_only_number',
			'param_name'       => 'col_gap',
			'heading'          => __( 'Columns Gap', 'soledad' ),
			'value'            => '',
			'std'              => '',
			'suffix'           => 'px',
			'min'              => 1,
			'edit_field_class' => 'vc_col-sm-6',
		),

		// tab team members
		array(
			'type'       => 'param_group',
			'heading'    => '',
			'param_name' => 'teammembers',
			'group'      => $group_team,
			'value'      => urlencode( json_encode( array(
				array(
					'name'          => 'Team member 1',
					'desc'          => 'I am text block. Click edit button to change this text.',
					'link'          => __( 'https://your-link.com', 'soledad' ),
					'image'         => '',
					'link_website'  => '#',
					'link_facebook' => '#',
					'link_twitter'  => '#'
				),
				array(
					'name'          => 'Team member 2',
					'desc'          => 'I am text block. Click edit button to change this text.',
					'link'          => __( 'https://your-link.com', 'soledad' ),
					'image'         => '',
					'link_website'  => '#',
					'link_facebook' => '#',
					'link_twitter'  => '#'
				),
				array(
					'name'          => 'Team member 3',
					'desc'          => 'I am text block. Click edit button to change this text.',
					'link'          => __( 'https://your-link.com', 'soledad' ),
					'image'         => '',
					'link_website'  => '#',
					'link_facebook' => '#',
					'link_twitter'  => '#'
				),
			) ) ),
			'params'     => array(
				array(
					'type'        => 'attach_image',
					'heading'     => __( 'Image', 'soledad' ),
					'param_name'  => 'image',
					'value'       => '',
					'description' => __( 'Select image from media library.', 'soledad' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Name', 'soledad' ),
					'param_name'  => 'name',
					'admin_label' => true,
				),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Position', 'soledad' ),
					'param_name' => 'position',
				),
				array(
					'type'       => 'textarea',
					'heading'    => __( 'Description', 'soledad' ),
					'param_name' => 'desc',
				),
				array(
					'type'             => 'textfield',
					'heading'          => __( 'Link Website', 'soledad' ),
					'param_name'       => 'link_website',
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'             => 'textfield',
					'heading'          => __( 'Link Facebook', 'soledad' ),
					'param_name'       => 'link_facebook',
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'             => 'textfield',
					'heading'          => __( 'Link Twitter', 'soledad' ),
					'param_name'       => 'link_twitter',
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'             => 'textfield',
					'heading'          => __( 'Link Linkedin', 'soledad' ),
					'param_name'       => 'link_linkedin',
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'             => 'textfield',
					'heading'          => __( 'Link Instagram', 'soledad' ),
					'param_name'       => 'link_instagram',
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'             => 'textfield',
					'heading'          => __( 'Link Youtube', 'soledad' ),
					'param_name'       => 'link_youtube',
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'             => 'textfield',
					'heading'          => __( 'Link Vimeo', 'soledad' ),
					'param_name'       => 'link_vimeo',
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'             => 'textfield',
					'heading'          => __( 'Link Pinterest', 'soledad' ),
					'param_name'       => 'link_pinterest',
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type'             => 'textfield',
					'heading'          => __( 'Link Dribbble', 'soledad' ),
					'param_name'       => 'link_dribbble',
					'edit_field_class' => 'vc_col-sm-6',
				),
			),
		),
	), Penci_Vc_Params_Helper::heading_block_params(), Penci_Vc_Params_Helper::params_heading_typo_color(), array(
		// General typo
		array(
			'type'             => 'textfield',
			'param_name'       => 'heading_general_settings',
			'heading'          => esc_html__( 'Team memeber Colors', 'soledad' ),
			'value'            => '',
			'group'            => $group_color,
			'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
		),
		array(
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Item Background Color', 'soledad' ),
			'param_name'       => 'team_bghcolor',
			'group'            => $group_color,
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Item Border Color', 'soledad' ),
			'param_name'       => 'team_borderhcolor',
			'group'            => $group_color,
			'edit_field_class' => 'vc_col-sm-6',
		),
		// Name typo
		array(
			'type'             => 'textfield',
			'param_name'       => 'heading_name_settings',
			'heading'          => esc_html__( 'Name Colors', 'soledad' ),
			'value'            => '',
			'group'            => $group_color,
			'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Name color', 'soledad' ),
			'param_name' => 'team_name_color',
			'group'      => $group_color,
		),
		array(
			'type'       => 'google_fonts',
			'param_name' => 'team_name_typo',
			'value'      => '',
			'group'      => $group_color,
		),
		array(
			'type'       => 'penci_responsive_sizes',
			'param_name' => 'team_name_size',
			'heading'    => __( 'Font Size for Name', 'soledad' ),
			'value'      => '',
			'std'        => '',
			'suffix'     => 'px',
			'min'        => 1,
			'group'      => $group_color,
		),
		array(
			'type'             => 'penci_responsive_sizes',
			'param_name'       => 'team_name_martop',
			'heading'          => __( 'Margin top for Name', 'soledad' ),
			'value'            => '',
			'std'              => '',
			'suffix'           => 'px',
			'min'              => 1,
			'group'            => $group_color,
			'edit_field_class' => 'vc_col-sm-6',
		),

		// Position typo
		array(
			'type'             => 'textfield',
			'param_name'       => 'heading_pos_settings',
			'heading'          => esc_html__( 'Positions Colors', 'soledad' ),
			'value'            => '',
			'group'            => $group_color,
			'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Position color', 'soledad' ),
			'param_name' => 'team_pos_color',
			'group'      => $group_color,
		),
		array(
			'type'       => 'google_fonts',
			'param_name' => 'team_pos_typo',
			'value'      => '',
			'group'      => $group_color,
		),
		array(
			'type'       => 'penci_responsive_sizes',
			'param_name' => 'team_pos_size',
			'heading'    => __( 'Font Size for Position', 'soledad' ),
			'value'      => '',
			'std'        => '',
			'suffix'     => 'px',
			'min'        => 1,
			'group'      => $group_color,
		),
		array(
			'type'             => 'penci_responsive_sizes',
			'param_name'       => 'team_pos_martop',
			'heading'          => __( 'Margin top for Position', 'soledad' ),
			'value'            => '',
			'std'              => '',
			'suffix'           => 'px',
			'min'              => 1,
			'group'            => $group_color,
			'edit_field_class' => 'vc_col-sm-6',
		),

		// Description typo
		array(
			'type'             => 'textfield',
			'param_name'       => 'heading_des_settings',
			'heading'          => esc_html__( 'Description colors', 'soledad' ),
			'value'            => '',
			'group'            => $group_color,
			'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Desctiption color', 'soledad' ),
			'param_name' => 'team_des_color',
			'group'      => $group_color,
		),
		array(
			'type'       => 'google_fonts',
			'param_name' => 'team_des_typo',
			'value'      => '',
			'group'      => $group_color,
		),
		array(
			'type'             => 'penci_responsive_sizes',
			'param_name'       => 'team_des_size',
			'heading'          => __( 'Font Size for Desctiption', 'soledad' ),
			'value'            => '',
			'std'              => '',
			'suffix'           => 'px',
			'min'              => 1,
			'group'            => $group_color,
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'             => 'penci_responsive_sizes',
			'param_name'       => 'team_des_martop',
			'heading'          => __( 'Margin top for Desctiption', 'soledad' ),
			'value'            => '',
			'std'              => '',
			'suffix'           => 'px',
			'min'              => 1,
			'group'            => $group_color,
			'edit_field_class' => 'vc_col-sm-6',
		),

		// Social typo
		array(
			'type'             => 'textfield',
			'param_name'       => 'heading_social_settings',
			'heading'          => esc_html__( 'Social Icon Colors', 'soledad' ),
			'value'            => '',
			'group'            => $group_color,
			'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
		),
		array(
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Social Icon Color', 'soledad' ),
			'param_name'       => 'team_social_color',
			'group'            => $group_color,
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Social Icon Background Color', 'soledad' ),
			'param_name'       => 'team_social_bgcolor',
			'group'            => $group_color,
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Social Icon Hover Color', 'soledad' ),
			'param_name'       => 'team_social_hcolor',
			'group'            => $group_color,
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Social Icon Background Hover Color', 'soledad' ),
			'param_name'       => 'team_social_bghcolor',
			'group'            => $group_color,
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'       => 'penci_responsive_sizes',
			'param_name' => 'team_social_martop',
			'heading'    => __( 'Margin top for Social Icon', 'soledad' ),
			'value'      => '',
			'std'        => '',
			'suffix'     => 'px',
			'min'        => 1,
			'group'      => $group_color,
		),
	), Penci_Vc_Params_Helper::extra_params() )
) );
