<?php
$options   = [];
$options[] = array(
	'label'       => esc_attr__( 'YouTube API Key', 'soledad' ),
	'id'          => 'penci_youtube_api_key',
	'type'        => 'soledad-fw-text',
	'default'     => '',
	'sanitize'    => 'sanitize_text_field',
	'description' => __( 'Please go to <a class="wp-customizer-link" href="https://developers.google.com/youtube/v3/getting-started?hl=en" target="_blank">https://developers.google.com/youtube/v3/getting-started?hl=en</a> and check this giude and get the YouTube API Key', 'soledad' ),
);
$options[] = array(
	'label'       => esc_attr__( 'Weather API Key', 'soledad' ),
	'id'          => 'penci_api_weather_key',
	'type'        => 'soledad-fw-text',
	'default'     => '',
	'sanitize'    => 'sanitize_text_field',
	'description' => __( '<a class="wp-customizer-link" href="' . esc_url( 'https://openweathermap.org/appid#get' ) . '" target="_blank">' . esc_html__( 'Click here to get an api key', 'soledad' ) . '</a>', 'soledad' )
);
$options[] = array(
	'label'       => esc_attr__( 'Google Map API Key', 'soledad' ),
	'id'          => 'penci_map_api_key',
	'type'        => 'soledad-fw-text',
	'default'     => '',
	'sanitize'    => 'sanitize_text_field',
	'description' => __( 'When you use "Penci Map" element from Elementor or WPBakery page builder, it required an Google Map API to make it works.', 'soledad' ),
);
$options[] = array(
	'label'    => __( 'Select "rel" Attribute Type for Social Media & Social Share Icons', 'soledad' ),
	'id'       => 'penci_rel_type_social',
	'default'  => 'noreferrer',
	'sanitize' => 'penci_sanitize_choices_field',
	'type'     => 'soledad-fw-select',
	'choices'  => array(
		'none'                         => __('None','soledad' ),
		'nofollow'                     => __('nofollow','soledad' ),
		'noreferrer'                   => __('noreferrer','soledad' ),
		'noopener'                     => __('noopener','soledad' ),
		'noreferrer_noopener'          => __('noreferrer noopener','soledad' ),
		'nofollow_noreferrer'          => __('nofollow noreferrer','soledad' ),
		'nofollow_noopener'            => __('nofollow noopener','soledad' ),
		'nofollow_noreferrer_noopener' => __('nofollow noreferrer noopener','soledad' ),
	)
);
$options[] = array(
	'label'    => __( 'Hide "Archive Template" in the Admin Side Panel Menu', 'soledad' ),
	'id'       => 'penci_hide_archive_builder',
	'type'     => 'soledad-fw-toggle',
	'default'  => false,
	'sanitize' => 'penci_sanitize_checkbox_field'
);

$options[] = array(
	'label'    => __( 'Hide "Post Template" in the Admin Side Panel Menu', 'soledad' ),
	'id'       => 'penci_hide_post_builder',
	'type'     => 'soledad-fw-toggle',
	'default'  => false,
	'sanitize' => 'penci_sanitize_checkbox_field'
);

$options[] = array(
	'label'    => __( 'Hide "Header Builder" in the Admin Side Panel Menu', 'soledad' ),
	'id'       => 'penci_hide_header_builder',
	'type'     => 'soledad-fw-toggle',
	'default'  => false,
	'sanitize' => 'penci_sanitize_checkbox_field'
);
$options[] = array(
	'label'    => __( 'Hide "Penci Blocks" in the Admin Side Panel Menu', 'soledad' ),
	'id'       => 'penci_hide_pcblocks',
	'type'     => 'soledad-fw-toggle',
	'default'  => false,
	'sanitize' => 'penci_sanitize_checkbox_field'
);
if ( get_option( 'penci_soledad_is_activated' ) ) {
	$options[] = array(
		'label'       => __( 'Disable New Version Update Notice on The Admin Page', 'soledad' ),
		'description' => __( 'You can check <a class="wp-customizer-link" href="https://imgresources.s3.amazonaws.com/notice-updates.png" target="_blank">this image</a> to understand what\'s "new version update notice on admin page". When a new version released, this notice will appear. This option will help you disable this notice if you want.', 'soledad' ),
		'id'          => 'penci_disable_notice_updates',
		'type'        => 'soledad-fw-toggle',
		'default'     => false,
		'sanitize'    => 'penci_sanitize_checkbox_field'
	);
}
$options[] = array(
	'label'    => __( 'Use Fontawesome Version 5', 'soledad' ),
	'id'       => 'penci_fontawesome_ver5',
	'type'     => 'soledad-fw-toggle',
	'default'  => false,
	'sanitize' => 'penci_sanitize_checkbox_field'
);
$options[] = array(
	'label'    => __( 'Enable Ajax Submit for MC4WP', 'soledad' ),
	'id'       => 'penci_mc4wp_ajax',
	'type'     => 'soledad-fw-toggle',
	'default'  => true,
	'sanitize' => 'penci_sanitize_checkbox_field'
);
$options[] = array(
	'label'    => __( 'Add "Last Modified" columns to the Posts > All Posts screen.', 'soledad' ),
	'id'       => 'penci_lastmodified_pcol',
	'type'     => 'soledad-fw-toggle',
	'default'  => false,
	'sanitize' => 'penci_sanitize_checkbox_field'
);
$options[] = array(
	'label'    => __( 'Add "Total Views" columns to the Posts > All Posts screen.', 'soledad' ),
	'id'       => 'penci_tviews_pcol',
	'type'     => 'soledad-fw-toggle',
	'default'  => false,
	'sanitize' => 'penci_sanitize_checkbox_field'
);
$options[] = array(
	'label'    => __( 'Disable Theme Options Panel', 'soledad' ),
	'id'       => 'penci_disable_theme_options',
	'type'     => 'soledad-fw-toggle',
	'default'  => false,
	'sanitize' => 'penci_sanitize_checkbox_field'
);
return $options;
