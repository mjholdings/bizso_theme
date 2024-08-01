<?php
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
/* Check page header has enable or not */

if ( ! function_exists( 'penci_is_pageheader' ) ) :
	function penci_is_pageheader() {
		if ( ! is_page() ) :
			return false;
		endif;

		static $show_page_title;
		$show_page_title  = get_theme_mod( 'penci_pheader_show' );
		$penci_page_title = get_post_meta( get_the_ID(), 'penci_pmeta_page_title', true );

		$pheader_show = isset( $penci_page_title['pheader_show'] ) ? $penci_page_title['pheader_show'] : '';
		if ( 'enable' == $pheader_show ) {
			$show_page_title = true;
		} elseif ( 'disable' == $pheader_show ) {
			$show_page_title = false;
		}

		return $show_page_title;
	}
endif;
if ( ! function_exists( 'penci_soledad_get_header_layout' ) ) :
	function penci_soledad_get_header_layout() {
		$header_layout = get_theme_mod( 'penci_header_layout' );
		if ( is_page() ) {
			$pmeta_page_header = get_post_meta( get_the_ID(), 'penci_pmeta_page_header', true );
			if ( isset( $pmeta_page_header['header_style'] ) && $pmeta_page_header['header_style'] ) {
				$header_layout = $pmeta_page_header['header_style'];
			}
		}

		if ( empty( $header_layout ) ) {
			$header_layout = 'header-1';
		}

		return $header_layout;
	}
endif;

if ( ! function_exists( 'penci_soledad_get_header_width' ) ) :
	function penci_soledad_get_header_width() {
		$header_width = get_theme_mod( 'penci_header_ctwidth' );
		if ( is_page() ) {
			$pmeta_page_header = get_post_meta( get_the_ID(), 'penci_pmeta_page_header', true );
			if ( isset( $pmeta_page_header['penci_header_width'] ) && $pmeta_page_header['penci_header_width'] ) {
				$header_width = $pmeta_page_header['penci_header_width'];
			}
		}

		$output = 'container';
		if ( $header_width ) {
			$output .= ' container-' . $header_width;
		}

		echo $output;
	}
endif;

if ( ! function_exists( 'penci_soledad_get_header_container_width' ) ) :
	function penci_soledad_get_header_container_width() {
		$header_width = get_theme_mod( 'penci_header_ctwidth' );
		if ( is_page() ) {
			$pmeta_page_header = get_post_meta( get_the_ID(), 'penci_pmeta_page_header', true );
			if ( isset( $pmeta_page_header['penci_header_width'] ) && $pmeta_page_header['penci_header_width'] ) {
				$header_width = $pmeta_page_header['penci_header_width'];
			}
		}

		$output = '1170';
		if ( $header_width ) {
			$output = $header_width;
		}

		return $output;
	}
endif;

if ( ! function_exists( 'penci_soledad_wpheader_classes' ) ) :
	function penci_soledad_wpheader_classes( $class = '' ) {
		$_featured_slider_all_page   = get_theme_mod( 'penci_featured_slider_all_page' );
		$_featured_slider            = get_theme_mod( 'penci_featured_slider' );
		$_vertical_nav_remove_header = get_theme_mod( 'penci_vertical_nav_remove_header' );
		$_vertical_nav_show          = get_theme_mod( 'penci_vertical_nav_show' );
		$header_layout               = penci_soledad_get_header_layout();

		$classes = 'header-' . $header_layout;
		if ( ( ( ! is_home() || ! is_front_page() ) && ! $_featured_slider_all_page ) || ( ( is_home() || is_front_page() ) && ! $_featured_slider ) ) {
			$classes .= ' has-bottom-line';
		}
		if ( $_vertical_nav_remove_header && $_vertical_nav_show ) {
			$classes .= ' penci-vernav-hide-innerhead';
		}

		if ( $class ) {
			$classes .= ' ' . $class;
		}

		return $classes;
	}
endif;

if ( ! function_exists( 'penci_soledad_sitenavigation_classes' ) ) :
	function penci_soledad_sitenavigation_classes( $class = '' ) {
		$menu_style    = get_theme_mod( 'penci_header_menu_style' );
		$header_layout = penci_soledad_get_header_layout();

		$classes = '';

		if ( in_array( $header_layout, array( 'header-1', 'header-4', 'header-7' ) ) ) {
			$classes .= 'header-layout-top';
		} else {
			$classes .= 'header-layout-bottom';
		}

		if ( $header_layout == 'header-9' ) {
			$classes .= ' header-6';
		}

		if ( $header_layout == 'header-10' || $header_layout == 'header-11' ) {
			$overflow_logo = get_theme_mod( 'penci_overflow_logo' );
			if ( $overflow_logo ) {
				$class .= ' penci-logo-overflow';
			}
		}

		$classes .= ' ' . $header_layout;
		$classes .= ' ' . ( $menu_style ? $menu_style : 'menu-style-1' );

		if ( get_theme_mod( 'penci_header_enable_padding' ) ) {
			$classes .= ' menu-item-padding';
		}
		if ( get_theme_mod( 'penci_disable_sticky_header' ) ) {
			$classes .= ' penci-disable-sticky-nav';
		}

		if ( $class ) {
			$classes .= ' ' . $class;
		}

		return $classes;
	}
endif;

if ( ! function_exists( 'penci_soledad_body_classes' ) ) :
	function penci_soledad_body_classes( $classes ) {

		$fontawesome_ver5 = get_theme_mod( 'penci_fontawesome_ver5' );
		if ( $fontawesome_ver5 ) {
			$classes[] = 'penci-fawesome-ver5';
		}

		if ( is_singular( 'portfolio' ) ) {

			if ( get_theme_mod( 'penci_portfolio_single_enable_2sidebar' ) ) {
				$classes[] = 'penci-two-sidebar';
			}
		} elseif ( is_home() || is_front_page() ) {

			$show_on_front = get_option( 'show_on_front' );
			if ( 'page' == $show_on_front ) {

				$sidebar_layout   = get_theme_mod( 'penci_page_default_template_layout' );
				$sidebar_position = get_post_meta( get_the_ID(), 'penci_sidebar_page_pos', true );
				if ( $sidebar_position ) {
					$sidebar_layout = $sidebar_position;
				}

				if ( 'two-sidebar' == $sidebar_layout ) {
					$classes[] = 'penci-two-sidebar';
				}

				// Header transparent
				$header_trans = penci_is_header_transparent();
				if ( $header_trans ) {
					$classes[] = 'penci-header-trans';
				}
			} elseif ( get_theme_mod( 'penci_two_sidebar_home' ) ) {
				$classes[] = 'penci-two-sidebar';
			}
		} elseif ( is_archive() || is_search() || is_404() ) {

			$is_two_sidebar_archive = get_theme_mod( 'penci_two_sidebar_archive' );

			if ( is_category() ) {
				$category_oj  = get_queried_object();
				$fea_cat_id   = $category_oj->term_id;
				$cat_meta     = get_option( "category_$fea_cat_id" );
				$sidebar_opts = isset( $cat_meta['cat_sidebar_display'] ) ? $cat_meta['cat_sidebar_display'] : '';
				if ( $sidebar_opts == 'two' ) {
					$is_two_sidebar_archive = true;
				} elseif ( $sidebar_opts ) {
					$is_two_sidebar_archive = false;
				}
			}

			if ( $is_two_sidebar_archive ) {
				$classes[] = 'penci-two-sidebar';
			}
		} elseif ( is_page() ) {
			$sidebar_layout   = get_theme_mod( 'penci_page_default_template_layout' );
			$sidebar_position = get_post_meta( get_the_ID(), 'penci_sidebar_page_pos', true );
			if ( $sidebar_position ) {
				$sidebar_layout = $sidebar_position;
			}

			if ( 'two-sidebar' == $sidebar_layout ) {
				$classes[] = 'penci-two-sidebar';
			}

			$show_page_title = penci_is_pageheader();
			if ( $show_page_title ) :
				$classes[] = 'penci-body-epageheader';
			endif;

			// Header transparent
			$header_trans = penci_is_header_transparent();
			if ( $header_trans ) {
				$classes[] = 'penci-header-trans';
			}
		} elseif ( is_single() ) {
			$sidebar_single_layout   = get_theme_mod( 'penci_single_layout' );
			$sidebar_single_position = get_post_meta( get_the_ID(), 'penci_post_sidebar_display', true );
			if ( $sidebar_single_position ) {
				$sidebar_single_layout = $sidebar_single_position;
			}

			if ( 'two' == $sidebar_single_layout ) {
				$classes[] = 'penci-two-sidebar';
			}
		}

		if ( is_singular( 'portfolio' ) || is_singular( 'product' ) ) {
			$classes[] = 'penci-port-product';
		}

		return $classes;
	}

	add_filter( 'body_class', 'penci_soledad_body_classes' );
endif;

/**
 * Get class sidebar position
 */
if ( ! function_exists( 'penci_is_header_transparent' ) ) :
	function penci_is_header_transparent() {
		$header_trans = false;
		if ( is_page() ) {
			$header_trans = get_theme_mod( 'penci_header_enable_transparent' );
		}

		$pmeta_page_header = get_post_meta( get_the_ID(), 'penci_pmeta_page_header', true );
		if ( isset( $pmeta_page_header['penci_edeader_trans'] ) ) {
			if ( 'yes' == $pmeta_page_header['penci_edeader_trans'] ) {
				$header_trans = true;
			} elseif ( 'no' == $pmeta_page_header['penci_edeader_trans'] ) {
				$header_trans = false;
			}
		}

		return $header_trans;
	}
endif;

/**
 * Get class sidebar position
 */
if ( ! function_exists( 'penci_get_sidebar_position_archive' ) ) :
	function penci_get_sidebar_position_archive() {
		$sidebar_position = 'right-sidebar';
		if ( get_theme_mod( 'penci_two_sidebar_archive' ) ) {
			$sidebar_position = 'two-sidebar';
		} elseif ( get_theme_mod( 'penci_left_sidebar_archive' ) ) {
			$sidebar_position = 'left-sidebar';
		}

		return $sidebar_position;
	}
endif;

if ( ! function_exists( 'get_list_custom_sidebar_option' ) ) :
	function get_list_custom_sidebar_option() {
		$list_sidebar = array(
			'main-sidebar'      => 'Main Sidebar',
			'main-sidebar-left' => 'Main Sidebar Left',
			'custom-sidebar-1'  => 'Custom Sidebar 1',
			'custom-sidebar-2'  => 'Custom Sidebar 2',
			'custom-sidebar-3'  => 'Custom Sidebar 3',
			'custom-sidebar-4'  => 'Custom Sidebar 4',
			'custom-sidebar-5'  => 'Custom Sidebar 5',
			'custom-sidebar-6'  => 'Custom Sidebar 6',
			'custom-sidebar-7'  => 'Custom Sidebar 7',
			'custom-sidebar-8'  => 'Custom Sidebar 8',
			'custom-sidebar-9'  => 'Custom Sidebar 9',
			'custom-sidebar-10' => 'Custom Sidebar 10',
		);

		$custom_sidebars = get_option( 'soledad_custom_sidebars' );
		if ( empty( $custom_sidebars ) || ! is_array( $custom_sidebars ) ) {
			return $list_sidebar;
		}

		foreach ( $custom_sidebars as $sidebar_id => $custom_sidebar ) {

			if ( empty( $custom_sidebar['name'] ) ) {
				continue;
			}
			$list_sidebar[ $sidebar_id ] = $custom_sidebar['name'];
		}

		return $list_sidebar;
	}
endif;

if ( ! function_exists( 'penci_get_option_yesno' ) ) {
	function penci_get_option_yesno( $default = false ) {
		$output = array();

		if ( $default ) {
			$output[''] = esc_html__( 'Default( follow Customize )', 'soledad' );
		}

		$output['no']  = esc_html__( 'No', 'soledad' );
		$output['yes'] = esc_html__( 'Yes', 'soledad' );

		return $output;
	}
}

if ( ! function_exists( 'penci_get_option_menus' ) ) {
	function penci_get_option_menus( $hide_empty = false ) {
		$output = array( '' => esc_html__( '-- Default Select -- ', 'soledad' ) );

		$menus = get_terms( 'nav_menu', array( 'hide_empty' => $hide_empty ) );

		foreach ( $menus as $menu ) {
			$output[ $menu->term_id ] = $menu->name;
		}

		return $output;
	}
}

if ( ! function_exists( 'penci_get_data_slider' ) ) :
	function penci_get_data_slider( $args ) {
		$items = $autoplay = $autotime = $speed = $loop = $showdots = $shownav = '';

		$args = wp_parse_args(
			$args,
			array(
				'items'                  => '1',
				'autoplay'               => '',
				'autotime'               => '',
				'auto_time'              => '',
				'speed'                  => '',
				'loop'                   => '',
				'showdots'               => '0',
				'shownav'                => '0',
				'transition'             => '',
				'carousel_slider_effect' => '',
				'single_slider_effect'   => '',
			)
		);
		extract( $args );

		$atimes = $autotime ? $autotime : $auto_time;

		$data = ' data-items="' . $items . '"';
		$data .= ' data-auto="' . ( 'yes' == $autoplay ? 'true' : 'false' ) . '"';

		$data .= $atimes ? ' data-autotime="' . $atimes . '"' : '';
		$data .= $speed ? ' data-speed="' . $speed . '"' : '';
		$data .= ! $loop ? ' data-loop="false"' : '';
		$data .= $showdots ? ' data-dots="true"' : '';
		$data .= ! $shownav ? ' data-nav="true"' : '';
		$data .= $transition ? ' data-anim="' . $transition . '"' : '';
		$data .= $carousel_slider_effect ? ' data-ceffect="' . $carousel_slider_effect . '"' : '';
		$data .= $single_slider_effect ? ' data-seffect="' . $single_slider_effect . '"' : '';

		return $data;
	}
endif;

if ( defined( 'ELEMENTOR_VERSION' ) || defined( 'WPB_VC_VERSION' ) ) {
	if ( ! function_exists( 'custom_css_title_block_pagebuilder' ) ) {
		add_action( 'soledad_theme/custom_css', 'custom_css_title_block_pagebuilder' );
		function custom_css_title_block_pagebuilder() {
			if ( get_theme_mod( 'penci_sidebar_heading_lowcase' ) ) : ?>
                .penci-block-vc .penci-border-arrow .inner-arrow { text-transform: none; }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_heading_size' ) ) : ?>
                .penci-block-vc .penci-border-arrow .inner-arrow { font-size: <?php echo get_theme_mod( 'penci_sidebar_heading_size' ); ?>px; }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_heading_image_8' ) ) : ?>
                .penci-block-vc .style-8.penci-border-arrow .inner-arrow { background-image: url(<?php echo get_theme_mod( 'penci_sidebar_heading_image_8' ); ?>); }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_heading8_repeat' ) ) : ?>
                .penci-block-vc .style-8.penci-border-arrow .inner-arrow { background-repeat: <?php echo get_theme_mod( 'penci_sidebar_heading8_repeat' ); ?>; background-size: auto; }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_heading_bg' ) ) : ?>
                .penci-block-vc .penci-border-arrow .inner-arrow { background-color: <?php echo get_theme_mod( 'penci_sidebar_heading_bg' ); ?>; }
                .penci-block-vc .style-2.penci-border-arrow:after{ border-top-color: <?php echo get_theme_mod( 'penci_sidebar_heading_bg' ); ?>; }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_heading_outer_bg' ) ) : ?>
                .penci-block-vc .penci-border-arrow:after { background-color: <?php echo get_theme_mod( 'penci_sidebar_heading_outer_bg' ); ?>; }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_heading_border_color' ) ) : ?>
                .penci-block-vc .penci-border-arrow .inner-arrow, .penci-block-vc.style-4 .penci-border-arrow .inner-arrow:before, .penci-block-vc.style-4 .penci-border-arrow .inner-arrow:after, .penci-block-vc.style-5 .penci-border-arrow, .penci-block-vc.style-7
                .penci-border-arrow, .penci-block-vc.style-9 .penci-border-arrow { border-color: <?php echo get_theme_mod( 'penci_sidebar_heading_border_color' ); ?>; }
                .penci-block-vc .penci-border-arrow:before { border-top-color: <?php echo get_theme_mod( 'penci_sidebar_heading_border_color' ); ?>; }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_heading_border_color5' ) ) : ?>
                .penci-block-vc .style-5.penci-border-arrow { border-color: <?php echo get_theme_mod( 'penci_sidebar_heading_border_color5' ); ?>; }
                .penci-block-vc .style-5.penci-border-arrow .inner-arrow{ border-bottom-color: <?php echo get_theme_mod( 'penci_sidebar_heading_border_color5' ); ?>; }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_heading_border_color7' ) ) : ?>
                .penci-block-vc .style-7.penci-border-arrow .inner-arrow:before, .penci-block-vc.style-9 .penci-border-arrow .inner-arrow:before { background-color: <?php echo get_theme_mod( 'penci_sidebar_heading_border_color7' ); ?>; }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_heading_border_inner_color' ) ) : ?>
                .penci-block-vc .penci-border-arrow:after { border-color: <?php echo get_theme_mod( 'penci_sidebar_heading_border_inner_color' ); ?>; }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_heading_color' ) ) : ?>
                .penci-block-vc .penci-border-arrow .inner-arrow { color: <?php echo get_theme_mod( 'penci_sidebar_heading_color' ); ?>; }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_remove_border_outer' ) ) : ?>
                .penci-block-vc .penci-border-arrow:after { content: none; display: none; }
                .penci-block-vc .widget-title{ margin-left: 0; margin-right: 0; margin-top: 0; }
                .penci-block-vc .penci-border-arrow:before{ bottom: -6px; border-width: 6px; margin-left: -6px; }
			<?php endif; ?>
			<?php if ( get_theme_mod( 'penci_sidebar_remove_arrow_down' ) ) : ?>
                .penci-block-vc .penci-border-arrow:before, .penci-block-vc .style-2.penci-border-arrow:after { content: none; display: none; }
			<?php
			endif;
		}
	}
}

/**
 * Get icon font awesome with each version
 *
 * Note important : if edit function
 *
 * @see penci_icon_by_ver()
 */
if ( ! function_exists( 'penci_icon_by_ver' ) ) :
	function penci_icon_by_ver( $class, $style = '', $sharing = false ) {

		if ( ( get_theme_mod( 'penci_outline_social_icon' ) && true != $sharing ) || ( get_theme_mod( 'penci_outline_social_share' ) && true == $sharing ) ) {
			if ( 'fab fa-facebook-f' == $class ) {
				$class = 'penciicon-facebook';
			} elseif ( 'fab fa-facebook-f' == $class ) {
				$class = 'penciicon-facebook';
			} elseif ( 'fab fa-twitter' == $class ) {
				$class = 'penciicon-twitter';
			} elseif ( 'fab fa-instagram' == $class ) {
				$class = 'penciicon-instagram';
			} elseif ( 'fab fa-pinterest' == $class ) {
				$class = 'penciicon-pinterest';
			} elseif ( 'fab fa-linkedin-in' == $class ) {
				$class = 'penciicon-linkedin';
			} elseif ( 'fab fa-flickr' == $class ) {
				$class = 'penciicon-flickr';
			} elseif ( 'fab fa-behance' == $class ) {
				$class = 'penciicon-behance';
			} elseif ( 'fab fa-tumblr' == $class ) {
				$class = 'penciicon-tumblr';
			} elseif ( 'fab fa-youtube' == $class ) {
				$class = 'penciicon-youtube';
			} elseif ( 'fas fa-envelope' == $class ) {
				$class = 'penciicon-email';
			} elseif ( 'fab fa-vk' == $class ) {
				$class = 'penciicon-vk';
			} elseif ( 'fab fa-vine' == $class ) {
				$class = 'penciicon-vine';
			} elseif ( 'fab fa-soundcloud' == $class ) {
				$class = 'penciicon-soundcloud';
			} elseif ( 'fab fa-snapchat' == $class ) {
				$class = 'penciicon-snapchat';
			} elseif ( 'fab fa-spotify' == $class ) {
				$class = 'penciicon-spotify';
			} elseif ( 'fab fa-github' == $class ) {
				$class = 'penciicon-github';
			} elseif ( 'fab fa-stack-overflow' == $class ) {
				$class = 'penciicon-stack-overflow';
			} elseif ( 'fab fa-twitch' == $class ) {
				$class = 'penciicon-twitch';
			} elseif ( 'fab fa-vimeo-v' == $class ) {
				$class = 'penciicon-vimeo';
			} elseif ( 'fab fa-steam' == $class ) {
				$class = 'penciicon-steam';
			} elseif ( 'fab fa-xing' == $class ) {
				$class = 'penciicon-xing';
			} elseif ( 'fab fa-whatsapp' == $class ) {
				$class = 'penciicon-whatsapp';
			} elseif ( 'fab fa-telegram' == $class ) {
				$class = 'penciicon-telegram';
			} elseif ( 'fab fa-reddit-alien' == $class ) {
				$class = 'penciicon-reddit';
			} elseif ( 'fab fa-odnoklassniki' == $class ) {
				$class = 'penciicon-odnoklassniki';
			} elseif ( 'fab fa-stumbleupon' == $class ) {
				$class = 'penciicon-stumbleupon';
			} elseif ( 'fab fa-weixin' == $class ) {
				$class = 'penciicon-wechat';
			} elseif ( 'fab fa-weibo' == $class ) {
				$class = 'penciicon-sina-weibo';
			} elseif ( 'penciicon-line' == $class ) {
				$class = 'penciicon-line-1';
			} elseif ( 'penciicon-viber' == $class ) {
				$class = 'penciicon-viber-1';
			} elseif ( 'penciicon-discord' == $class ) {
				$class = 'penciicon-discord-1';
			} elseif ( 'fas fa-rss' == $class ) {
				$class = 'penciicon-rss';
			} elseif ( 'fab fa-slack' == $class ) {
				$class = 'penciicon-slack';
			} elseif ( 'fab fa-tripadvisor' == $class ) {
				$class = 'penciicon-tripadvisor';
			} elseif ( 'penciicon-tik-tok' == $class ) {
				$class = 'penciicon-tik-tok-1';
			} elseif ( 'penciicon-blogger-1' == $class ) {
				$class = 'penciicon-blogger';
			} elseif ( 'penciicon-deviantart-1' == $class ) {
				$class = 'penciicon-deviantart';
			} elseif ( 'penciicon-evernote' == $class ) {
				$class = 'penciicon-evernote-1';
			} elseif ( 'penciicon-forrst' == $class ) {
				$class = 'penciicon-forrst-1';
			} elseif ( 'penciicon-grooveshark' == $class ) {
				$class = 'penciicon-grooveshark-1';
			} elseif ( 'penciicon-myspace-logo' == $class ) {
				$class = 'penciicon-myspace';
			} elseif ( 'fab fa-paypal' == $class ) {
				$class = 'penciicon-brand';
			} elseif ( 'fab fa-skype' == $class ) {
				$class = 'penciicon-skype';
			} elseif ( 'fab fa-windows' == $class ) {
				$class = 'penciicon-windows';
			} elseif ( 'fab fa-wordpress' == $class ) {
				$class = 'penciicon-wordpress-logo';
			}
		}

		$fontawesome_ver5 = get_theme_mod( 'penci_fontawesome_ver5' );
		if ( ! $fontawesome_ver5 ) {
			$class = str_replace( array( 'fab ', 'fal ', 'far ', 'fas ' ), 'fa ', $class );

			if ( 'fa fa-facebook-f' == $class ) {
				$class = str_replace( 'facebook-f', 'facebook', $class );
			} elseif ( 'fa fa-thumbtack' == $class ) {
				$class = str_replace( 'thumbtack', 'thumb-tack', $class );
			} elseif ( 'fa fa-linkedin-in' == $class ) {
				$class = str_replace( 'linkedin-in', 'linkedin', $class );
			} elseif ( 'fa fa-image' == $class ) {
				$class = str_replace( 'fa-image', 'fa-picture-o', $class );
			} elseif ( 'fa fa-clock' == $class ) {
				$class = str_replace( 'fa-clock', 'fa-clock-o', $class );
			} elseif ( 'fa fa-user-circle-o' == $class ) {
				$class = str_replace( 'fa-user-circle-o', 'fa-user-circle', $class );
			} elseif ( 'fa fa-sign-out-alt' == $class ) {
				$class = str_replace( 'fa-sign-out-alt', 'fa-sign-out', $class );
			} elseif ( 'fa fa-sync' == $class ) {
				$class = str_replace( 'fa-sync', 'fa-refresh', $class );
			} elseif ( 'fa fa-youtube' == $class ) {
				$class = str_replace( 'fa-youtube', 'fa-youtube-play', $class );
			} elseif ( 'fa fa-envelope-o' == $class ) {
				$class = str_replace( 'fa-envelope-o', 'fa-envelope', $class );
			} elseif ( 'fa fa-snapchat-ghost' == $class ) {
				$class = str_replace( 'fa-snapchat-ghost', 'fa-snapchat', $class );
			} elseif ( 'fa fa-vimeo-v' == $class ) {
				$class = str_replace( 'fa-vimeo-v', 'fa-vimeo', $class );
			} elseif ( 'fa fa-times' == $class ) {
				$class = str_replace( 'fa-times', 'fa-close', $class );
			} elseif ( 'fa fa-heart' == $class ) {
				$class = str_replace( 'fa-heart', 'fa-heart-o', $class );
			} elseif ( 'fa fa-comment' == $class ) {
				$class = str_replace( 'fa-comment', 'fa-comment-o', $class );
			}
		}

		if ( is_numeric( $class ) ) {

			$icon_path = wp_get_original_image_path( $class );

			if ( is_string( $icon_path ) && 'image/svg+xml' === mime_content_type( $icon_path ) ) {
				$return = '<i class="pccsi-svg" style="' . esc_attr( penci_get_icon_color( $class ) ) . '">' . file_get_contents( $icon_path ) . '</i>';
			} else {
				$return = '<i class="pccsi-img" style="' . esc_attr( penci_get_icon_color( $class ) ) . '">' . wp_get_attachment_image( $class, 'full' ) . '</i>';
			}
		} else {
			$return = '<i class="penci-faicon ' . esc_attr( $class ) . '" ' . ( $style ? ' ' . $style : '' ) . '></i>';
		}

		return $return;
	}
endif;

if ( ! function_exists( 'penci_get_icon_color_list' ) ) :
	function penci_get_icon_color_list() {
		$custom_social_icons = get_option( 'penci_custom_socials', array() );

		$keys = array();

		foreach ( $custom_social_icons as $key => $icon_data ) {
			if ( isset( $icon_data['icon'] ) && $icon_data['icon'] ) {
				$keys[ $icon_data['icon'] ] = isset( $icon_data['color'] ) && $icon_data['color'] ? $icon_data['color'] : '';
			}
		}

		return $keys;
	}
endif;

if ( ! function_exists( 'penci_get_icon_color' ) ) :
	function penci_get_icon_color( $class ) {

		$keys = penci_get_icon_color_list();

		return isset( $keys[ $class ] ) && $keys[ $class ] ? '--pcci:' . $keys[ $class ] : '';
	}
endif;
/**
 * Show icon font awesome with each version
 */
if ( ! function_exists( 'penci_fawesome_icon' ) ) :
	function penci_fawesome_icon( $class, $style = '' ) {
		echo penci_icon_by_ver( $class, $style );
	}
endif;

if ( ! function_exists( 'penci_svg_menu_icon' ) ) :
	function penci_svg_menu_icon() {
		echo '<svg width=18px height=18px viewBox="0 0 512 384" version=1.1 xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink><g stroke=none stroke-width=1 fill-rule=evenodd><g transform="translate(0.000000, 0.250080)"><rect x=0 y=0 width=512 height=62></rect><rect x=0 y=161 width=512 height=62></rect><rect x=0 y=321 width=512 height=62></rect></g></g></svg>';
	}
endif;

/**
 * Trims post title.
 *
 * @param $id
 * @param int $length
 * @param null $more
 *
 * @return string
 */
if ( ! function_exists( 'penci_get_trim_post_title' ) ) {
	function penci_get_trim_post_title( $id = '', $length = 20, $more = '...' ) {
		if ( empty( $id ) ) {
			$id = get_the_ID();
		}

		if ( ! $length || ! is_numeric( $length ) ) {
			return get_the_title( $id );
		}

		return sanitize_text_field( wp_trim_words( wp_strip_all_tags( get_the_title( $id ) ), $length, $more ) );
	}
}
if ( ! function_exists( 'penci_trim_post_title' ) ) {
	function penci_trim_post_title( $id = '', $length = 20, $more = '...' ) {
		echo penci_get_trim_post_title( $id, $length, $more );
	}
}

if ( ! function_exists( 'penci_get_post_countview' ) ) {
	function penci_get_post_countview( $post_id = null ) {

		echo '<span>';
		penci_fawesome_icon( 'fas fa-eye' );
		echo penci_get_post_views( $post_id );
		echo ' ' . penci_get_setting( 'penci_trans_countviews' );
		echo '</span>';
	}
}

/*
Hook for Soledad Penci Page Speed */
/* Options from Soledad */
if ( ! function_exists( 'penci_classes_slider_lazy' ) ) {
	function penci_classes_slider_lazy() {

		return 'penci-lazy';
	}
}

if ( ! function_exists( 'penci_get_html_animation_loading' ) ) {
	function penci_get_html_animation_loading( $style_animation ) {

		$style_animation = $style_animation == 'df' ? get_theme_mod( 'penci_block_lajax', 's9' ) : $style_animation;

		$animation = array(
			's1' => '<div class="penci-loader-effect penci-loading-animation-1"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div></div>',
			's2' => '<div class="penci-loader-effect penci-loading-animation-2"><div class="penci-loading-animation"></div></div>',
			's3' => '<div class="penci-loader-effect penci-loading-animation-3"><div class="penci-loading-animation"></div></div>',
			's4' => '<div class="penci-loader-effect penci-loading-animation-4"><div class="penci-loading-animation"></div></div>',
			's5' => '<div class="penci-loader-effect penci-loading-animation-5 penci-three-bounce"><div class="penci-loading-animation one"></div><div class="penci-loading-animation two"></div><div class="penci-loading-animation three"></div></div>',
			's6' => '<div class="penci-loader-effect penci-loading-animation-6 penci-load-thecube"><div class="penci-loading-animation penci-load-cube penci-load-c1"></div><div class="penci-loading-animation penci-load-cube penci-load-c2"></div><div class="penci-loading-animation penci-load-cube penci-load-c4"></div><div class="penci-loading-animation penci-load-cube penci-load-c3"></div></div>',
			's7' => '<div class="penci-loader-effect penci-loading-animation-7"><div class="penci-loading-animation"></div><div class="penci-loading-animation penci-loading-animation-inner-2"></div><div class="penci-loading-animation penci-loading-animation-inner-3"></div><div class="penci-loading-animation penci-loading-animation-inner-4"></div><div class="penci-loading-animation penci-loading-animation-inner-5"></div><div class="penci-loading-animation penci-loading-animation-inner-6"></div><div class="penci-loading-animation penci-loading-animation-inner-7"></div><div class="penci-loading-animation penci-loading-animation-inner-8"></div><div class="penci-loading-animation penci-loading-animation-inner-9"></div></div>',
			's8' => '<div class="penci-loader-effect penci-loading-animation-8"><div class="penci-loading-animation"></div><div class="penci-loading-animation penci-loading-animation-inner-2"></div></div>',
			's9' => '<div class="penci-loader-effect penci-loading-animation-9"> <div class="penci-loading-circle"> <div class="penci-loading-circle1 penci-loading-circle-inner"></div> <div class="penci-loading-circle2 penci-loading-circle-inner"></div> <div class="penci-loading-circle3 penci-loading-circle-inner"></div> <div class="penci-loading-circle4 penci-loading-circle-inner"></div> <div class="penci-loading-circle5 penci-loading-circle-inner"></div> <div class="penci-loading-circle6 penci-loading-circle-inner"></div> <div class="penci-loading-circle7 penci-loading-circle-inner"></div> <div class="penci-loading-circle8 penci-loading-circle-inner"></div> <div class="penci-loading-circle9 penci-loading-circle-inner"></div> <div class="penci-loading-circle10 penci-loading-circle-inner"></div> <div class="penci-loading-circle11 penci-loading-circle-inner"></div> <div class="penci-loading-circle12 penci-loading-circle-inner"></div> </div> </div>',
		);

		return isset( $animation[ $style_animation ] ) ? $animation[ $style_animation ] : $animation['s9'];
	}
}
if ( ! function_exists( 'penci_add_postviews_col' ) ) {
	add_filter( 'manage_post_posts_columns', 'penci_add_postviews_col' );
	function penci_add_postviews_col( $columns ) {
		$columns['penci_thumbnail'] = __( 'Thumbnail', 'soledad' );
		if ( get_theme_mod( 'penci_tviews_pcol' ) ) {
			$columns['penci_views'] = '<span title="Total Views" class="dashicons dashicons-chart-bar"></span><span class="dash-title title">Total Views</span>';
		}

		return $columns;
	}
}

if ( ! function_exists( 'penci_register_totalview_sortable' ) && get_theme_mod( 'penci_tviews_pcol' ) ) {
	function penci_register_totalview_sortable( $columns ) {
		$columns['penci_views'] = 'views';

		return $columns;
	}

	add_filter( 'manage_edit-post_sortable_columns', 'penci_register_totalview_sortable' );
}


if ( ! function_exists( 'penci_register_totalview_order' ) && get_theme_mod( 'penci_tviews_pcol' ) ) {
	add_action( 'pre_get_posts', 'penci_register_totalview_order' );
	function penci_register_totalview_order( $query ) {
		if ( ! is_admin() ) {
			return;
		}

		$orderby = $query->get( 'orderby' );

		if ( 'views' == $orderby ) {
			$count_key = penci_get_postviews_key();
			$query->set( 'meta_key', $count_key );
			$query->set( 'orderby', 'meta_value_num' );
		}
	}
}

if ( ! function_exists( 'penci_posts_column_order' ) ) {
	add_filter( 'manage_post_posts_columns', 'penci_posts_column_order' );
	function penci_posts_column_order( $columns ) {
		$n_columns = array();
		$move      = 'penci_thumbnail'; // what to move
		$before    = 'title'; // move before this
		foreach ( $columns as $key => $value ) {
			if ( $key == $before ) {
				$n_columns[ $move ] = $move;
			}
			$n_columns[ $key ] = $value;
		}

		return $n_columns;
	}
}

if ( ! function_exists( 'penci_add_postviews_col_content' ) ) {
	add_action( 'manage_post_posts_custom_column', 'penci_add_postviews_col_content', 10, 2 );
	function penci_add_postviews_col_content( $column, $post_id ) {
		switch ( $column ) {
			case 'penci_views':
				$count_key = penci_get_postviews_key();
				$count     = get_post_meta( $post_id, $count_key, true );

				echo $count;
				break;
			case 'penci_thumbnail':
				if ( has_post_thumbnail( $post_id ) ) {
					echo wp_get_attachment_image( get_post_thumbnail_id( $post_id ), array( 50, 50 ) );
				} else {
					echo '<img width="50" height="50" src="' . PENCI_SOLEDAD_URL . '/images/nothumb.jpg" alt=""/>';
				}
				break;
		}
	}
}

if ( is_admin() && isset( $_GET['pcfbdm'] ) && $_GET['pcfbdm'] ) {
	$pcfbdm = $_GET['pcfbdm'];
	if ( 'yes' == $pcfbdm ) {
		update_option( 'pcfbdm', 'yes' );
	}
}

add_action(
	'admin_notices',
	function () {
		$link   = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$link   = add_query_arg( array( 'pcfbdm' => 'yes' ), $link );
		$pcfbdm = get_option( 'pcfbdm', false );
		if ( $pcfbdm != 'yes' ) {
			?>
            <div class="notice pc-fb-group-notice">
                <p class="fbp1">
                    We just created the Soledad Facebook Users Group - Join Now</p>
                <p class="fbp2">Join with other users that love to use Soledad to build their websites - for sharing,
                    showcase your works, assist, discuss, and updates related to Soledad WordPress Theme.</p>
                <div class="pc-fbbtn-gr">
                    <a class="pc-fb-btn" target="_blank" href="https://www.facebook.com/groups/soledad/">Join Facebook
                        Group</a>
                    <a class="pc-fb-btn pc-fb-dismiss" href="<?php echo esc_url( $link ); ?>">Alreay Joined</a>
                    <a class="pc-fb-dismiss" href="<?php echo esc_url( $link ); ?>">No, Thanks</a>
                </div>
            </div>
			<?php
		}
	}
);

if ( ! function_exists( 'penci_switch_value' ) ) {
	function penci_switch_value( $value ) {
		switch ( $value ) {
			case 'yes':
				$return = true;
				break;
			case 'no':
				$return = false;
				break;
			default:
				$return = $value;
				break;
		}

		return $return;
	}
}

if ( ! function_exists( 'penci_get_elementor_content_css' ) ) {
	function penci_get_elementor_content_css( $id ) {
		$post    = new Elementor\Core\Files\CSS\Post( $id );
		$meta    = $post->get_meta();
		$content = $post->get_content();

		ob_start();

		if ( $post::CSS_STATUS_FILE === $meta['status'] ) {
			?>
            <link rel="stylesheet" id="elementor-post-<?php echo esc_attr( $id ); ?>-css"
                  href="<?php echo esc_url( $post->get_url() ); ?>" type="text/css" media="all">
			<?php
		} else {
			echo '<style>' . $content . '</style>';
			\Elementor\Plugin::$instance->frontend->print_fonts_links();
		}

		return ob_get_clean();
	}
}

if ( ! function_exists( 'penci_get_elementor_content_main' ) ) {
	function penci_get_elementor_content_main( $id ) {
		ob_start();

		echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $id );

		wp_deregister_style( 'elementor-post-' . $id );
		wp_dequeue_style( 'elementor-post-' . $id );

		return ob_get_clean();
	}
}

if ( ! function_exists( 'penci_get_elementor_content' ) ) {
	function penci_get_elementor_content( $id ) {

		$html = penci_get_elementor_content_css( $id );
		$html .= penci_get_elementor_content_main( $id );

		return $html;
	}
}

if ( ! function_exists( 'penci_get_afc_fields' ) ) {
	function penci_get_afc_fields( $showimg = false ) {

		$acf_fields_array = array();

		$acf_fields = get_posts(
			array(
				'post_type'      => 'acf-field',
				'posts_per_page' => - 1,
			)
		);

		$fields_support = apply_filters(
			'penci_acf_fields',
			array(
				'text',
				'textarea',
				'number',
				'range',
				'email',
				'url',
			)
		);

		if ( $showimg ) {
			$fields_support[] = 'image';
		}

		if ( $acf_fields ) {
			foreach ( $acf_fields as $acf_field ) {
				$field_data = unserialize( $acf_field->post_content );
				if ( in_array( $field_data['type'], $fields_support ) ) {
					$acf_fields_array[ $acf_field->post_excerpt ] = $acf_field->post_title;
				}
			}
		}

		return $acf_fields_array;
	}
}

if ( ! function_exists( 'penci_get_field_type' ) ) {
	function penci_get_field_type( $meta ) {
		global $wpdb;
		$type = 'text';
		if ( ! $meta ) {
			return $type;
		}
		$meta     = esc_sql( $meta );
		$querystr = "SELECT * FROM $wpdb->posts WHERE $wpdb->posts.post_excerpt = '{$meta}' AND $wpdb->posts.post_type = 'acf-field'";
		$posts    = $wpdb->get_results( $querystr );
		if ( $posts && isset( $posts[0]->post_content ) ) {
			$meta_data = unserialize( $posts[0]->post_content );
			$type      = $meta_data['type'];
		}

		return $type;
	}
}

if ( ! function_exists( 'penci_show_custom_meta_fields' ) ) {
	function penci_show_custom_meta_fields( $args = array() ) {

		$default_args = array(
			'id'        => get_the_ID(),
			'validator' => get_theme_mod( 'penci_cpost_cmeta_enable' ),
			'keys'      => get_theme_mod( 'penci_cpost_cmeta_fields' ),
			'acf'       => get_theme_mod( 'penci_cpost_cmeta_acf' ),
			'label'     => get_theme_mod( 'penci_cpost_cmeta_label' ),
			'divider'   => get_theme_mod( 'penci_cpost_divider_cmeta_label', ':' ),
		);

		$args = wp_parse_args( $args, $default_args );

		if ( ! $args['validator'] ) {
			return false;
		}

		if ( 'no' === $args['validator'] ) {
			return false;
		}

		$return = $label_html = '';

		$args['keys'] = is_array( $args['keys'] ) ? $args['keys'] : explode( ',', preg_replace( '/\s*/m', '', $args['keys'] ) );
		$args['acf']  = is_array( $args['acf'] ) ? $args['acf'] : explode( ',', preg_replace( '/\s*/m', '', $args['acf'] ) );

		$custom_showing_metas = array_filter( array_merge( $args['keys'], $args['acf'] ) );
		$labels               = penci_get_afc_fields();

		if ( $custom_showing_metas ) {

			foreach ( $custom_showing_metas as $meta ) {
				$value = get_post_meta( $args['id'], $meta, true );

				if ( $args['label'] ) {
					$label_html = isset( $labels[ $meta ] ) && $labels[ $meta ] ? $labels[ $meta ] . do_shortcode( $args['divider'] ) . ' ' : '';
				}

				if ( $value && is_string( $value ) ) {
					$return .= '<span class="pccsmt-field ' . esc_attr( $meta ) . '">' . $label_html . $value . '</span>';
				}
			}
		}

		return $return;
	}
}

if ( ! function_exists( 'penci_estimate_readingtime' ) ) {
	function penci_estimate_readingtime( $id ) {

		$return = get_theme_mod( 'penci_readtime_default' ) ? get_theme_mod( 'penci_readtime_default' ) : '';
		$auto   = get_theme_mod( 'penci_readtime_auto' );
		$wpm    = get_theme_mod( 'penci_readtime_wpm', 200 );
		$text   = get_the_content( null, false, $id );

		if ( $auto ) {
			$totalWords = count( preg_split( '~[\p{Z}\p{P}]+~u', $text, null, PREG_SPLIT_NO_EMPTY ) );
			$minutes    = round( $totalWords / $wpm );
			$return     = $minutes . ' ' . penci_get_setting( 'penci_trans_minutes' );
		}

		return $return;
	}
}

add_action(
	'penci_single_meta_content',
	function () {
		echo penci_show_custom_meta_fields();
	}
);

add_filter(
	'coauthors_default_between_last',
	function () {
		return ' & ';
	}
);

if ( ! function_exists( 'penci_animated_heading_stroke' ) ) {
	function penci_animated_heading_stroke( $stroke, $style ) {
		$gradient_svg    = '';
		$gradient_stroke = '';

		$colorstyle = esc_attr( $style );

		if ( 'gradient' === $colorstyle ) {
			$gradient_svg    = '<linearGradient x1="0" y1="0" x2="100%" y2="100%" id="penci-highlight-gradient"><stop offset="0"/><stop offset="100%"/></linearGradient>';
			$gradient_stroke = 'stroke="url(#penci-highlight-gradient)"';
		}

		$strokes = array(
			'circle'           => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">' . $gradient_svg . '<path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M281.68,15.89S135.3,14.19,22.05,81.45s331.78,76.17,441,35.68S363.86-35.6,178.77,26.39" transform="translate(0.75 -3.61)"/></svg>',
			'curly'            => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">' . $gradient_svg . '<path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M6.5,75.5s25-29,50,0,50,0,50,0,25-32,50,0,50-1,50-1,25-30,50,1,50,0,50,0,27-28,50,0,50,0,50,0,26-25,50,0,36,7,36,7" transform="translate(-3.09 -56.78)"/></svg>',
			'underline'        => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">' . $gradient_svg . '<path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M3,77.5s200.54-11,493,0" transform="translate(-2.75 -68.11)"/></svg>',
			'double'           => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">' . $gradient_svg . '<path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M3.69,18.7s240.11-30,492.31,0" transform="translate(-3.14 -0.87)"/><path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M3.65,144S248.43,128,496,144" transform="translate(-3.14 -0.87)"/></svg>',
			'double-underline' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">' . $gradient_svg . '<path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M3,59.5s152.5-13,493-3" transform="translate(-2.62 -48.22)"/><path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M3,83.5s200.54-11,493,0" transform="translate(-2.62 -48.22)"/></svg>',
			'underline-zigzag' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">' . $gradient_svg . '<path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M9.5,52.5s361-31,478,0" transform="translate(-9.11 -34.22)"/><path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M484.5,55.5s-386-2-432,15c0,0,317-12,358,5,0,0-177-4-227,11" transform="translate(-9.11 -34.22)"/></svg>',
			'diagonal'         => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">' . $gradient_svg . '<path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M7.5,6.5s257,84,483,136" transform="translate(-6.1 -2.22)"/></svg>',
			'strikethrough'    => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">' . $gradient_svg . '<path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M7.5,75.5s200,10,485,0" transform="translate(-7.28 -71)"/></svg>',
			'x'                => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">' . $gradient_svg . '<path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M7.5,6.5s257,84,483,136" transform="translate(-6.1 -2.22)"/><path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M490.5,6.5s-310,103-483,136" transform="translate(-6.1 -2.22)"/></svg>',
			'check'            => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">' . $gradient_svg . '<path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M12.3,55.4,33.8,76.9,87.7,23.1"/></svg>',
			'pan'              => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">' . $gradient_svg . '<path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M72.7,72.7A32.1,32.1,0,0,0,27.3,27.3M72.7,72.7A32.1,32.1,0,0,1,27.3,27.3M72.7,72.7,27.3,27.3"/></svg>',
			'click'            => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">' . $gradient_svg . '<path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M64,64,56.8,82.1,42.3,42.3,82.1,56.8Zm0,0L82.1,82.1M35.8,17.9l2.8,10.5M28.4,38.6,17.9,35.8M60.2,24.4l-7.6,7.7M32.1,52.6l-7.7,7.6"/></svg>',
			'heart'            => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">' . $gradient_svg . '<path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M22.6,27.3a16,16,0,0,0,0,22.7L50,77.4,77.4,50A16.1,16.1,0,1,0,54.7,27.3L50,32l-4.7-4.7A16,16,0,0,0,22.6,27.3Z"/></svg>',
			'bolt'             => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">' . $gradient_svg . '<path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M54,42V13.9L17.9,58H46V86.1L82.1,42Z"/></svg>',
			'sparkle'          => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">' . $gradient_svg . '<path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M21.4,13.3V29.6m-8.1-8.2H29.6m-4.1,49V86.7m-8.1-8.1H33.7M54.1,13.3l9.3,28L86.7,50,63.4,58.7l-9.3,28-9.3-28L21.4,50l23.4-8.7Z"/></svg>',
			'line'             => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600" preserveAspectRatio="xMidYMid slice">' . $gradient_svg . '<path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M38.38581848144531,139.37005615234375C71.25983301798502,65.15746370951335,197.83462778727215,4.724402109781902,282.8739929199219,22.440937042236328C367.9133580525716,40.15747197469075,550.787363688151,189.7637564341227,548.6220092773438,245.6692657470703C546.4566548665365,301.5747750600179,347.04721705118817,320.86612192789715,269.8818664550781,357.8739929199219C192.71651585896808,394.8818639119466,124.21258036295572,504.1338144938151,85.6299057006836,467.71649169921875C47.04723103841146,431.2991689046224,5.511803944905601,213.58264859517413,38.38581848144531,139.37005615234375C71.25983301798502,65.15746370951335,197.83462778727215,4.724402109781902,282.8739929199219,22.440937042236328"></path></svg>',
			'line-1'           => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 400" preserveAspectRatio="none">' . $gradient_svg . '<path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M91.47981262207031,57.39909744262695C91.47981262207031,57.39909744262695,709.4169921875,64.57398223876953,709.4169921875,64.57398223876953C709.4169921875,64.57398223876953,722.8699340820312,340.8071594238281,722.8699340820312,340.8071594238281C722.8699340820312,340.8071594238281,100.44842529296875,301.34527587890625,100.44842529296875,301.34527587890625C100.44842529296875,301.34527587890625,89.68608856201172,99.55155944824219,89.68608856201172,99.55155944824219" transform="matrix(0.99500625,0,-0.35089289569710413,0.99500625,50.274723994013186,1.4479939959287833)"></path></svg>',
			'line-2'           => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1422 800" preserveAspectRatio="none">' . $gradient_svg . '<path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="m765 113.13-5.37-1.02q-5.37-1-16.05-2.53-10.68-1.52-20.88-2.35-10.2-.83-21.71-1.54-11.52-.72-26.24-1.13-14.73-.42-30.08-.65-15.35-.24-33.02-.4-17.66-.15-27.03-.2-9.36-.06-18.75-.1l-19.1-.08-19.48-.07-19.35-.04-19.1-.04-18.91-.02q-9.38 0-27.34.92-17.95.92-35.98 2.55-18.04 1.62-33.85 3.9-15.82 2.3-28.3 5.18-12.47 2.89-23.76 6.84-11.28 3.95-23.06 9.37-11.77 5.43-23.69 12.13-11.91 6.7-23.48 14.38-11.57 7.68-22.54 15.73-10.96 8.06-20.52 15.7-9.57 7.63-18.61 16.18-9.05 8.54-17.56 18.03-8.52 9.48-16.09 19-7.57 9.51-14.41 20.22-6.84 10.7-11.96 22.28-5.12 11.58-8.59 22.92-3.46 11.34-5.37 23.23-1.9 11.88-2.16 23.8-.25 11.9 1.25 23.7 1.5 11.8 5.92 25.15 4.43 13.35 10.14 25.45 5.71 12.1 12.41 22.7 6.7 10.58 15.06 20.63 8.35 10.05 17.66 19.06 9.3 9.01 18.9 17.04 9.57 8.03 21 16.06 11.41 8.03 23.33 15.5 11.91 7.48 23.83 14.3 11.92 6.82 24.45 12.71 12.53 5.9 25.55 11.48 13.03 5.57 27.45 10.7 14.42 5.12 30.28 10.27 15.86 5.14 32.47 10.03 16.6 4.89 34.86 9.07 18.27 4.18 28.5 6.13 10.21 1.94 20.55 3.83 10.35 1.88 20.3 3.56 9.95 1.67 19.63 3.2 9.68 1.52 19.16 2.94t19.05 2.6q9.56 1.19 19.07 2.06 9.5.88 19.99 1.53 10.5.66 20.6 1.15 10.1.48 19.75.83 9.65.36 19.3.77 9.64.4 19.28 1t18.87 1.02l27 1.28q17.78.84 33.83 1.5 16.05.65 31.38 1 15.34.36 32.45.56 17.1.2 33.93.31 16.83.11 33.17.17l32.39.08 31.34.04h57.85q13.97-.01 27.58-.56 13.6-.54 28.24-2.22 14.63-1.68 29-4.22 14.37-2.53 27.85-4.94 13.48-2.41 26.4-5.12 12.91-2.7 25.68-6.07t24.7-7.45q11.95-4.08 21.99-8.85t17.6-10.76q7.56-6 14.27-13.96 6.7-7.96 14.06-19.28t11.18-24.44q3.82-13.12 5.3-22.25t2.16-18.84q.67-9.71-.22-21.33-.9-11.63-2.86-23.98-1.97-12.35-4.8-25.99-2.83-13.63-6.76-26.8-3.93-13.15-8.71-26.47-4.79-13.33-10.66-27.2-5.88-13.88-11.96-26.66-6.08-12.78-11.93-24.22-5.84-11.43-12.63-22.93-6.8-11.5-14.26-22.29-7.47-10.79-15.02-20.35-7.55-9.56-15.03-17.73-7.48-8.18-15.27-15.45-7.8-7.28-15.47-13.81-7.68-6.53-16.87-13.07-9.19-6.53-18.7-12.6-9.52-6.06-19.73-12.1-10.21-6.06-20.2-11.87-9.97-5.82-18.69-10.41-8.7-4.6-21.5-10.52t-21.94-9.56q-9.14-3.63-17.77-6.81-8.63-3.18-20.83-7.16-12.2-4-24.42-7.05-12.21-3.07-22.35-4.81-10.14-1.75-20.65-3.33-10.51-1.58-21.06-2.94-10.55-1.37-21.73-2.21-11.17-.85-22.6-1.32-11.42-.47-23.76-.74-12.34-.26-26.23-.42-13.9-.16-26.8-.25-12.9-.08-24.86-.12-11.96-.04-22.75-.05-10.8-.02-23.44-.01-12.65 0-27.25-3.16l-14.6-3.17v-.01l14.6-3.16q14.62-3.15 27.27-3.11l23.45.07 22.77.07q11.97.04 24.9.11 12.91.07 26.87.2 13.95.11 26.4.36t24.06.71q11.6.47 23.15 1.34 11.55.86 22.23 2.24 10.69 1.38 21.32 2.96 10.63 1.59 21.11 3.39 10.48 1.8 23.24 5.03 12.77 3.23 25.19 7.31 12.42 4.09 21.08 7.3 8.67 3.2 18.22 7.01 9.55 3.81 22.66 9.9 13.1 6.1 22.04 10.84t18.97 10.6q10.03 5.84 20.47 12.02 10.44 6.19 20.08 12.34 9.63 6.15 19.38 13.11 9.74 6.96 17.54 13.63 7.8 6.68 15.93 14.3 8.12 7.64 15.89 16.17 7.77 8.54 15.57 18.46 7.8 9.91 15.47 21.02 7.67 11.12 14.71 23.05 7.04 11.93 12.9 23.42 5.84 11.48 12.05 24.52 6.21 13.04 12.27 27.27 6.05 14.22 10.93 27.75 4.88 13.52 9 27.3 4.12 13.77 7.03 27.62 2.91 13.84 4.97 26.67 2.07 12.83 3 25.36.95 12.53.21 22.85-.73 10.32-2.36 20.13-1.62 9.81-4.19 19.63-2.56 9.82-6.84 19-4.29 9.17-9.9 17.02-5.6 7.85-12.95 16.46-7.36 8.62-16.28 15.53-8.91 6.9-19.77 12-10.86 5.09-23.17 9.27-12.31 4.19-25.42 7.63-13.1 3.44-26.27 6.18-13.16 2.74-26.66 5.14-13.5 2.4-28.14 4.97t-29.72 4.3q-15.08 1.72-29.04 2.26-13.95.53-27.93.52l-28.26-.04-29.6-.06-31.35-.06-32.41-.1q-16.36-.08-33.21-.19-16.86-.11-34.03-.32-17.17-.2-32.6-.6-15.43-.39-31.62-1.1-16.2-.7-33.9-1.57l-27-1.31q-9.3-.45-18.84-1.04-9.53-.6-19.14-1-9.6-.41-19.32-.78-9.71-.36-19.9-.84-10.19-.48-20.86-1.13-10.67-.65-20.35-1.54-9.7-.9-19.4-2.1-9.72-1.2-19.25-2.63-9.52-1.42-19.26-2.95-9.74-1.53-19.77-3.2-10.02-1.67-20.42-3.53-10.4-1.86-20.75-3.8-10.36-1.92-20.06-3.96-9.69-2.04-18.63-4.22-8.95-2.17-25.79-7.1-16.83-4.91-32.84-10.06-16.01-5.15-30.83-10.4-14.81-5.25-27.94-10.87-13.13-5.61-26.13-11.73-13-6.12-25.2-13.1-12.2-6.99-24.34-14.6-12.14-7.6-24.01-15.95-11.88-8.34-21.78-16.67-9.9-8.32-19.61-17.74-9.7-9.42-18.58-20.14-8.87-10.72-15.98-22.02-7.1-11.31-13.05-23.93-5.95-12.63-10.72-27.1-4.77-14.49-6.36-27.32-1.58-12.82-1.27-25.62.32-12.8 2.37-25.38 2.05-12.6 5.8-24.77 3.76-12.18 9.23-24.47 5.47-12.28 12.71-23.6 7.25-11.33 15.14-21.24 7.9-9.9 16.73-19.7 8.82-9.8 18.3-18.72 9.48-8.92 19.27-16.7 9.8-7.8 20.9-15.94 11.12-8.15 23.17-16.13 12.06-7.99 24.35-14.87 12.3-6.89 24.46-12.46 12.18-5.57 24.23-9.72t25.1-7.1q13.04-2.94 29.26-5.25 16.22-2.3 34.37-3.94 18.16-1.63 27.34-2.28 9.18-.65 18.38-.94 9.2-.29 18.59-.29l18.91.01h38.46l19.5.01q9.7 0 19.1.02l18.77.03q9.38.02 27.08.1 17.7.08 33.12.27 15.42.2 30.32.57 14.9.37 26.54 1.1 11.65.72 22.16 1.6 10.5.87 21.6 2.47 11.09 1.6 16.46 2.62 5.37 1.02 6.08 1.25.72.22 1.37.62.64.4 1.17.93.53.53.91 1.18.4.65.61 1.37.22.72.26 1.47.04.76-.1 1.5t-.45 1.42q-.31.69-.78 1.28-.47.59-1.07 1.05-.6.46-1.28.77-.7.3-1.43.43-.75.14-1.5.09l-.75-.05Z" transform="translate(0.75 -3.61)"/></svg>',
			'underline-1'      => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 400" preserveAspectRatio="none">' . $gradient_svg . '<path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M25.112102508544922,196.4125518798828C33.61434400558472,196.2944645436605,72.56351873397827,193.39012603759767,89.68608856201172,195.51568603515625C106.80865839004517,197.64124603271483,139.21523365020752,213.3826528676351,155.1569366455078,212.55604553222656C171.0986396408081,211.72943819681802,191.15992251078288,189.59191563924153,210.76231384277344,189.23765563964844C230.364705174764,188.88339564005534,284.5515521494548,211.63676325480142,304.0358581542969,209.86546325683594C323.520164159139,208.09416325887045,330.4035807800293,175.31239893595378,358.744384765625,175.7847442626953C387.0851887512207,176.25708958943684,485.1554173787435,213.21672345479328,519.282470703125,213.45289611816406C553.4095240275064,213.68906878153484,592.1942961629231,176.16141868591308,617.9371948242188,177.57846069335938C643.6800934855144,178.99550270080567,694.6053327433268,222.56202580769857,714.7981567382812,224.21524047851562C734.9909807332357,225.86845514933268,763.8609510294597,194.62181615193686,771.3004150390625,190.134521484375"></path></svg>',
			'underline-2'      => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 687 155" preserveAspectRatio="none">' . $gradient_svg . '<g class="style-' . $colorstyle . '" ' . $gradient_stroke . '><path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M20 58c27-13.33333333 54-20 81-20 40.5 0 40.5 20 81 20s40.626917-20 81-20 40.123083 20 80.5 20 40.5-20 81-20 40.5 20 81 20 40.626917-20 81-20c26.915389 0 53.748722 6.66666667 80.5 20" opacity=".1"></path><path class="style-' . $colorstyle . '" ' . $gradient_stroke . ' d="M20 78c27-13.3333333 54-20 81-20 40.5 0 40.5 20 81 20s40.626917-20 81-20 40.123083 20 80.5 20 40.5-20 81-20 40.5 20 81 20 40.626917-20 81-20c26.915389 0 53.748722 6.6666667 80.5 20" opacity=".2"></path><path d="M20 98c27-13.3333333 54-20 81-20 40.5 0 40.5 20 81 20s40.626917-20 81-20 40.123083 20 80.5 20 40.5-20 81-20 40.5 20 81 20 40.626917-20 81-20c26.915389 0 53.748722 6.6666667 80.5 20" opacity=".6"></path><path d="M20 118c27-13.3333333 54-20 81-20 40.5 0 40.5 20 81 20s40.626917-20 81-20 40.123083 20 80.5 20 40.5-20 81-20 40.5 20 81 20 40.626917-20 81-20c26.915389 0 53.748722 6.6666667 80.5 20"></path></g></svg>',
		);

		return $strokes[ $stroke ];
	}
}
if ( ! function_exists( 'penci_home_url_multilang' ) ) {
	function penci_home_url_multilang( $path = '', $scheme = null ) {
		if ( function_exists( 'pll_current_language' ) ) {
			if ( isset( $path[0] ) && $path[0] !== '/' ) {
				$path = '/' . $path;
			}

			$polylang_setting = get_option( 'polylang', array() );
			$default_lang     = $polylang_setting['default_lang'];
			$current_lang     = pll_current_language();

			if ( isset( $polylang_setting['hide_default'] ) && $polylang_setting['hide_default'] ) {
				if ( $default_lang === $current_lang ) {
					return home_url( $path, $scheme );
				}
			}

			return home_url( $current_lang . $path, $scheme );
		}

		return home_url( $path, $scheme );
	}
}

if ( ! function_exists( 'penci_get_theme_name' ) ) {
	function penci_get_theme_name( $name = 'Penci', $dot = false ) {

		$theme_name = get_theme_mod( 'admin_wel_page_sname' );

		if ( $theme_name && get_theme_mod( 'activate_white_label' ) ) {
			$name = $dot ? '.' . $theme_name : $theme_name;
		}

		return $name . ' ';
	}
}

if ( ! function_exists( 'penci_get_theme_author' ) ) {
	function penci_get_theme_author( $name = 'PenciDesign' ) {

		$theme_author = get_theme_mod( 'admin_wel_page_author' );

		if ( $theme_author && get_theme_mod( 'activate_white_label' ) ) {
			$name = $theme_author;
		}

		return $name;
	}
}

add_filter(
	'the_title',
	function ( $post_title, $post_id ) {
		if ( is_single() && isset( get_queried_object()->ID ) && get_queried_object()->ID == $post_id ) {
			$custom_post_title = get_post_meta( $post_id, 'penci_cpost_title', true );
			$post_title        = ! empty( $custom_post_title ) ? $custom_post_title : $post_title;
		}

		return $post_title;
	},
	10,
	2
);

add_filter(
	'penci_cat_bgcolor',
	function ( $default, $id, $featured ) {
		$out    = '';
		$colors = get_option( "category_$id" );
		if ( get_theme_mod( 'penci_catdesign' ) || $featured ) {
			if ( isset( $colors['penci_archive_bgcolor'] ) && $colors['penci_archive_bgcolor'] ) {
				$out .= 'background-color:' . $colors['penci_archive_bgcolor'] . ';';
			}
		}

		return $out;
	},
	10,
	3
);

add_filter(
	'penci_cat_color',
	function ( $default, $id, $featured ) {
		$out = '';

		$colors = get_option( "category_$id" );

		if ( get_theme_mod( 'penci_catdesign' ) || $featured ) {

			if ( isset( $colors['penci_archive_color'] ) && $colors['penci_archive_color'] ) {
				$out .= 'color:' . $colors['penci_archive_color'] . ';';
			}
		} elseif ( isset( $colors['penci_archivepage_color'] ) && $colors['penci_archivepage_color'] ) {
			$out .= 'color:' . $colors['penci_archivepage_color'] . ';';
		}

		return $out;
	},
	10,
	3
);

add_action(
	'wp_footer',
	function () {
		if ( ! get_theme_mod( 'penci_floatads_enable' ) || penci_is_mobile() ) {
			return false;
		}

		wp_enqueue_script( 'penci-float-banner' );

		$ad_left  = get_theme_mod( 'penci_floatads_banner_left' );
		$ad_right = get_theme_mod( 'penci_floatads_banner_right' );
		$ad_w     = get_theme_mod( 'penci_floatads_width', 200 );
		$ad_h     = get_theme_mod( 'penci_floatads_height' );

		$margin_top  = get_theme_mod( 'penci_floatads_mtop' );
		$margin_stop = get_theme_mod( 'penci_floatads_scroll_mtop' );

		$style = 'width: ' . $ad_w . 'px; height: ' . $ad_h . 'px; display:none; z-index:9999; position:absolute; text-align:center; top:0px; overflow:hidden;';

		if ( get_theme_mod( 'penci_floatads_always_center' ) ) {
			$style .= 'top: 50%;transform: translateY(-50%);';
		}

		$out = '<div data-w="' . $ad_w . '" data-mt="' . $margin_top . '" data-mts="' . $margin_stop . '" id="side-ads-container" class="container"></div>';
		$out .= '<div style="' . $style . '" class="side-ads" id="side-ads-left">' . do_shortcode( $ad_left ) . '</div>';
		$out .= '<div style="' . $style . '" class="side-ads" id="side-ads-right">' . do_shortcode( $ad_right ) . '</div>';

		echo $out;
	}
);

add_filter(
	'theme_mod_penci_logo',
	function ( $value ) {
		$default = $value;
		if ( penci_is_mobile() ) {
			$value = get_theme_mod( 'penci_mobile_logo' ) ? get_theme_mod( 'penci_mobile_logo' ) : $default;
		}

		return $value;
	}
);

if ( ! function_exists( 'penci_archive_query_vars_filter' ) ) {
	function penci_archive_query_vars_filter( $vars ) {
		$vars[] = 'pc_archive_sort';

		return $vars;
	}

	add_filter( 'query_vars', 'penci_archive_query_vars_filter' );
}

if ( ! function_exists( 'penci_archive_query_filter' ) ) {
	function penci_archive_query_filter( $query ) {

		$sort = get_query_var( 'pc_archive_sort' );

		if ( $query->is_main_query() && ! is_admin() && $sort ) {
			$query->set( 'order', $sort );
		}
	}

	add_action( 'pre_get_posts', 'penci_archive_query_filter', 99 );
}

add_action(
	'penci_action_before_the_content',
	function () {
		$post_id = get_the_ID();
		echo '<i class="penci-post-countview-number-check" style="display:none">' . penci_get_post_views( $post_id ) . '</i>';
	}
);

if ( ! function_exists( 'penci_get_jetpack_post_view' ) ) {
	function penci_get_jetpack_post_view( $post_id ) {

		if ( class_exists( 'Automattic\Jetpack\Stats\WPCOM_Stats' ) ) {

			$post_id = $post_id ? $post_id : get_the_ID();

			$cached_view = get_post_meta( $post_id, '_jetpack_post_view', true );

			if ( ! $cached_view ) {

				$jp_view_data  = ( new Automattic\Jetpack\Stats\WPCOM_Stats() )->get_post_views( (int) $post_id );
				$encoded_array = wp_json_encode( $jp_view_data );
				if ( ! $encoded_array ) {
					return new WP_Error( 'stats_encoding_error', 'Failed to encode stats array' );
				}

				$encoded_array = json_decode( $encoded_array );

				return isset( $encoded_array->views ) && $encoded_array->views ? $encoded_array->views : 0;
			} else {
				return $cached_view;
			}
		}

		return false;
	}
}

if ( ! function_exists( 'penci_set_jetpack_post_view' ) ) {
	function penci_set_jetpack_post_view() {
		if ( is_singular() ) {
			$view = penci_get_jetpack_post_view( get_the_ID() );
			if ( $view ) {
				update_post_meta( get_the_ID(), '_jetpack_post_view', $view );
			}
		}
	}

	add_action( 'init', 'penci_set_jetpack_post_view', 99 );
}
if ( ! function_exists( 'penci_jetpack_option' ) ) {
	function penci_jetpack_option() {
		$return = array();
		if ( class_exists( 'Automattic\Jetpack\Stats\WPCOM_Stats' ) ) {
			$return = array( 'jetpack' => __( 'Jetpack Post Views', 'soledad' ) );
		}

		return $return;
	}
}

add_filter(
	'theme_mod_penci_home_layout',
	function ( $value ) {

		global $wp_query;

		$custom_layout = get_theme_mod( 'penci_blogpage_layout' );

		if ( isset( $wp_query ) && (bool) $wp_query->is_posts_page && $custom_layout ) {
			$value = $custom_layout;
		}

		return $value;
	}
);

add_filter(
	'template_include',
	function ( $template ) {
		global $wp_query;
		$overwrite   = get_theme_mod( 'penci_overwrite_post_page' );
		$page_option = get_option( 'show_on_front' ) == 'page';
		$blog_page   = isset( $wp_query ) && (bool) $wp_query->is_posts_page && $overwrite && $page_option;

		$page_id = get_option( 'page_for_posts' );

		if ( $blog_page && did_action( 'elementor/loaded' ) && \Elementor\Plugin::$instance->documents->get( $page_id )->is_built_with_elementor() ) {
			$template = locate_template( array( 'page-blog.php' ) );
		} elseif ( $blog_page ) {
			$template = locate_template( array( 'index.php' ) );
		}

		return $template;
	},
	10
);

add_filter(
	'views_plugins',
	function ( $views ) {
		$views['soledad_plugins'] = '<a href="' . esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ) . '"><strong>' . __( 'Soledad Recommend Plugins', 'soledad' ) . '</strong></a>';

		return $views;
	}
);

if ( ! function_exists( 'penci_get_user_id_by_display_name' ) ) {
	function penci_get_user_id_by_display_name( $display_name ) {
		global $wpdb;

		if ( ! $user = $wpdb->get_row( $wpdb->prepare( "SELECT `ID` FROM $wpdb->users WHERE `display_name` = %s", $display_name ) ) ) {
			return false;
		}

		return $user->ID;
	}
}

add_filter(
	'the_author',
	function ( $name ) {

		$author_show = get_theme_mod( 'penci_meta_author_display', 'author-name' );
		if ( 'author-avatar' == $author_show || 'author-name-avatar' == $author_show ) {

			$author_w = get_theme_mod( 'penci_meta_author_aw', 22 );
			$user_id  = penci_get_user_id_by_display_name( $name );

			if ( ! $user_id ) {
				return $name;
			}
			$user_avatar = get_avatar( $user_id, $author_w );

			if ( 'author-avatar' == $author_show ) {
				$name = $user_avatar;
			} elseif ( 'author-name-avatar' == $author_show ) {
				$name = $user_avatar . '<strong class="author-a-name">' . $name . '</strong>';
			}
		}

		return $name;
	},
	10,
	1
);

if ( ! function_exists( 'penci_author_update_name' ) ) {
	function penci_author_update_name( $showing = false, $show_avatar = false, $avawidth = 22 ) {

		$enable                = ! get_theme_mod( 'penci_single_meta_author' );
		$penci_extra_author    = get_post_meta( get_the_ID(), 'penci_extra_author', true );
		$penci_extra_author_id = get_post_meta( get_the_ID(), 'penci_extra_author_id', true );

		$enable = $penci_extra_author_id ? $penci_extra_author_id : $enable;

		$avatar_html = '';
		$come        = 'customizer';

		if ( $showing ) {
			$come = 'builder';
		}

		$showing = $penci_extra_author && $penci_extra_author_id;

		$showing = $showing ? $showing : get_theme_mod( 'penci_single_meta_update_author' );

		if ( ! $showing ) {
			return false;
		}

		$last_id = get_post_meta( get_the_ID(), '_edit_last', true );
		$text    = penci_get_setting( 'penci_trans_updated_by' );

		if ( $penci_extra_author ) {
			$text = penci_get_setting( 'penci_trans_' . $penci_extra_author );
		}

		if ( $penci_extra_author_id ) {
			$last_id = $penci_extra_author_id;
		}

		if ( $last_id && $last_id != get_the_author_meta( 'ID' ) && $enable ) {

			if ( ! $show_avatar && 'builder' == $come ) {
				$avatar_html = get_avatar( $last_id, $avawidth );
			}

			?>
            <span class="author-post byline">
				<span class="author vcard"><?php echo $text; ?><a
                            class="author-url url fn n"
                            href="<?php echo get_author_posts_url( $last_id ); ?>"> <?php echo $avatar_html . apply_filters( 'the_author', get_the_author_meta( 'display_name', $last_id ) ); ?></a>
				</span>
			</span>
			<?php
		}
	}
}

add_action(
	'wp_ajax_penci_get_users',
	function () {
		check_ajax_referer( 'penci-adm-users', 'nonce' );
		$search_key = isset( $_REQUEST['search'] ) && $_REQUEST['search'] ? esc_attr( $_REQUEST['search'] ) : '';
		if ( $search_key ) {
			$blogusers = get_users(
				array(
					'search'         => $search_key,
					'search_columns' => array(
						'ID',
						'user_login',
						'user_email',
						'user_url',
						'user_nicename',
						'display_name',
					),
				)
			);
		} else {
			$blogusers = get_users();
		}
		$items = array();
		foreach ( $blogusers as $user ) {
			$items[] = array(
				'id'   => $user->ID,
				'text' => $user->display_name,
			);
		}
		wp_send_json_success( $items );
	}
);

if ( ! function_exists( 'penci_coauthors_posts_links' ) ) {
	function penci_coauthors_posts_links() {
		$out         = '';
		$author_show = get_theme_mod( 'penci_meta_author_display', 'author-name' );
		$author_w    = get_theme_mod( 'penci_meta_author_aw', 22 );
		if ( function_exists( 'coauthors__echo' ) ) {
			$author_list = coauthors__echo(
				'ID',
				'field',
				array(
					'between'     => ',',
					'betweenLast' => ',',
					'before'      => '',
					'after'       => '',
				),
				null,
				false
			);
			if ( $author_list ) {
				$author_ids = explode( ',', $author_list );
			}
			$current = 0;
			$total   = count( $author_ids );
			foreach ( $author_ids as $author_id ) {
				++ $current;

				$out .= $current == 2 && $total > 2 ? ', ' : ( ( $current == $total && $total > 1 ) ? ' & ' : '' );

				$user_avatar = get_avatar( $author_id, $author_w );
				$name        = get_the_author_meta( 'display_name', $author_id );
				$author_url  = get_author_posts_url( $author_id );

				if ( ! $name && function_exists( 'get_the_coauthor_meta' ) ) {

					$name = get_the_coauthor_meta( 'display_name', $author_id );
					$name = $name[ $author_id ];

					$author_url = get_the_coauthor_meta( 'url', $author_id );
					$author_url = isset( $author_url[ $author_id ] ) && $author_url[ $author_id ] ? $author_url[ $author_id ] : '';

					$author_email = get_the_coauthor_meta( 'email', $author_id );
					$user_avatar  = isset( $author_email[ $author_id ] ) && $author_email[ $author_id ] ? get_avatar( $author_email[ $author_id ], $author_w ) : '';

				}

				if ( 'author-avatar' == $author_show ) {
					$name_out = $user_avatar;
				} elseif ( 'author-name-avatar' == $author_show ) {
					$name_out = $user_avatar . '<strong class="author-a-name">' . $name . '</strong>';
				} else {
					$name_out = $name;
				}

				$out .= '<a title="' . $name . '" class="author-url url fn n" href="' . esc_url( $author_url ) . '">' . $name_out . '</a>';
			}
		}

		echo $out;
	}
}

add_action(
	'penci_single_meta_content',
	function () {
		if ( get_theme_mod( 'penci_single_font_changer' ) ) {
			?>
            <span class="penci-font-changer">
				<div class="penci-font-changer-popup">
					<span class="penci-font-changer-btn"><?php echo penci_get_setting( 'penci_trans_a1' ); ?><small><?php echo penci_get_setting( 'penci_trans_a2' ); ?></small></span>
					<div class="penci-fcpopup-ct-wrapper">
						<div class="penci-fchanger-pcontent">
							<span class="penci-font-changer-slider"></span>
							<strong class="penci-font-changer-reset"><?php echo penci_get_setting( 'penci_trans_reset' ); ?></strong>
						</div>
					</div>
				</div>
			</span>
			<?php

		}
	},
	99999
);

if ( ! function_exists( 'penci_sortArrayByArray' ) ) {
	function penci_sortArrayByArray( array $array, array $orderArray ) {
		$ordered = array();
		foreach ( $orderArray as $key ) {
			if ( array_key_exists( $key, $array ) ) {
				$ordered[ $key ] = $array[ $key ];
				unset( $array[ $key ] );
			}
		}

		return $ordered + $array;
	}
}
if ( ! function_exists( 'penci_get_custom_fonts' ) ) {
	function penci_get_custom_fonts() {
		$fontfamily1  = penci_get_option( 'soledad_custom_fontfamily1' );
		$fontfamily2  = penci_get_option( 'soledad_custom_fontfamily2' );
		$fontfamily3  = penci_get_option( 'soledad_custom_fontfamily3' );
		$fontfamily4  = penci_get_option( 'soledad_custom_fontfamily4' );
		$fontfamily5  = penci_get_option( 'soledad_custom_fontfamily5' );
		$fontfamily6  = penci_get_option( 'soledad_custom_fontfamily6' );
		$fontfamily7  = penci_get_option( 'soledad_custom_fontfamily7' );
		$fontfamily8  = penci_get_option( 'soledad_custom_fontfamily8' );
		$fontfamily9  = penci_get_option( 'soledad_custom_fontfamily9' );
		$fontfamily10 = penci_get_option( 'soledad_custom_fontfamily10' );

		$list_fonts = array();

		if ( $fontfamily1 ) {
			$list_fonts[ $fontfamily1 ] = $fontfamily1;
		}
		if ( $fontfamily2 ) {
			$list_fonts[ $fontfamily2 ] = $fontfamily2;
		}

		if ( $fontfamily3 ) {
			$list_fonts[ $fontfamily3 ] = $fontfamily3;
		}

		if ( $fontfamily4 ) {
			$list_fonts[ $fontfamily4 ] = $fontfamily4;
		}

		if ( $fontfamily5 ) {
			$list_fonts[ $fontfamily5 ] = $fontfamily5;
		}

		if ( $fontfamily6 ) {
			$list_fonts[ $fontfamily6 ] = $fontfamily6;
		}

		if ( $fontfamily7 ) {
			$list_fonts[ $fontfamily7 ] = $fontfamily7;
		}

		if ( $fontfamily8 ) {
			$list_fonts[ $fontfamily8 ] = $fontfamily8;
		}

		if ( $fontfamily9 ) {
			$list_fonts[ $fontfamily9 ] = $fontfamily9;
		}

		if ( $fontfamily10 ) {
			$list_fonts[ $fontfamily10 ] = $fontfamily10;
		}

		return $list_fonts;
	}
}

/**
 * Merge 2 array fonts to one array
 *
 * @return array fonts $penci_font_browser_arr
 * @since 1.0
 */
if ( ! function_exists( 'penci_all_fonts' ) ) {
	function penci_all_fonts( $df = null ) {
		$array_df = array();
		if ( 'select' == $df ) {
			$array_df = array( '' => '- Select -' );
		}

		return array_merge(
			$array_df,
			penci_get_custom_fonts(),
			penci_font_browser(),
			penci_list_google_fonts_array()
		);
	}
}

if ( ! function_exists( 'penci_get_option' ) ) {
	function penci_get_option( $key = null, $default = false ) {
		static $data;

		$data = get_option( 'penci_soledad_options' );

		if ( empty( $data ) ) {
			return '';
		}

		if ( $key === null ) {
			return $data;
		}

		if ( isset( $data[ $key ] ) ) {
			return $data[ $key ];
		}

		return get_option( $key, $default );
	}
}

/**
 * Include default fonts support by browser
 *
 * @return array list $penci_font_browser_arr
 * @since 2.0
 */
if ( ! function_exists( 'penci_font_browser' ) ) {
	function penci_font_browser() {
		$penci_font_browser_arr = array( '-apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"' => 'System Font' );
		$penci_font_browser     = array(
			'Arial, Helvetica, sans-serif',
			'Helvetica, sans-serif',
			'"Arial Black", Gadget, sans-serif',
			'"Comic Sans MS", cursive, sans-serif',
			'Impact, Charcoal, sans-serif',
			'"Lucida Sans Unicode", "Lucida Grande", sans-serif',
			'Tahoma, Geneva, sans-serif',
			'"Trebuchet MS", Helvetica, sans-serif',
			'Verdana, Geneva, sans-serif',
			'Georgia, serif',
			'"Palatino Linotype", "Book Antiqua", Palatino, serif',
			'"Times New Roman", Times, serif',
			'"Courier New", Courier, monospace',
			'"Lucida Console", Monaco, monospace',
		);
		foreach ( $penci_font_browser as $font ) {
			$penci_font_browser_arr[ $font ] = $font;
		}

		return $penci_font_browser_arr;
	}
}


add_action(
	'penci_action_before_the_content',
	function () {
		if ( ! get_theme_mod( 'penci_post_stickyshare' ) ) {
			return;
		}

		$class = '';

		$style = get_theme_mod( 'penci_post_stickyshare_style', 'style-1' );
		$side  = get_theme_mod( 'penci_post_stickyshare_pos', 'left' );

		$class .= ' share-' . $style . ' pos-' . $side;

		if ( 'style-3' == $style ) {
			$class .= ' penci-social-textcolored';
		} else {
			$class .= ' tags-share-box-s2';
		}

		echo '<div class="penci-social-fixed-share tags-share-box tags-share-box-n2 pcnew-share hide-txt post-share disable-btnplus ' . $class . '">';
		penci_soledad_social_share( '' );
		echo '</div>';
	}
);

add_action(
	'wp_footer',
	function () {
		$render = true;

		if ( defined( 'IFRAME_REQUEST' ) ) {
			$render = false;
		}

		if ( function_exists( 'elementor_location_exits' ) && elementor_location_exits( 'footer', true ) ) {
			$render = false;
		}

		if ( is_page_template( 'elementor_canvas' ) ) {
			$render = false;
		}

		if ( $render ) {
			get_template_part( 'template-parts/footer/footer' );
		} else {
			get_template_part( 'template-parts/header/vertical-nav' );
			/* Menu Hamburger */
			if ( get_theme_mod( 'penci_menu_hbg_show' ) && ! get_theme_mod( 'penci_vertical_nav_show' ) ) {
				get_template_part( 'template-parts/menu-hamburger' );
			}
			if ( is_singular( 'post' ) && get_theme_mod( 'penci_related_post_popup' ) ) :
				get_template_part( 'inc/templates/related_posts-popup' );
			endif;
			$gprd_desc       = penci_get_setting( 'penci_gprd_desc' );
			$gprd_accept     = penci_get_setting( 'penci_gprd_btn_accept' );
			$gprd_rmore      = penci_get_setting( 'penci_gprd_rmore' );
			$gprd_rmore_link = penci_get_setting( 'penci_gprd_rmore_link' );
			$penci_gprd_text = penci_get_setting( 'penci_gprd_policy_text' );
			if ( get_theme_mod( 'penci_enable_cookie_law' ) && $gprd_desc && $gprd_accept ) :
				?>
                <div class="penci-wrap-gprd-law penci-wrap-gprd-law-close penci-close-all">
                    <div class="penci-gprd-law">
                        <p>
							<?php
							if ( $gprd_desc ) :
								echo $gprd_desc;
							endif;
							?>
							<?php
							if ( $gprd_accept ) :
								echo '<a aria-label="GPRD Accept" class="penci-gprd-accept" href="#">' . $gprd_accept . '</a>';
							endif;
							?>
							<?php
							if ( $gprd_rmore ) :
								echo '<a class="penci-gprd-more" href="' . $gprd_rmore_link . '">' . $gprd_rmore . '</a>';
							endif;
							?>
                        </p>
                    </div>
					<?php if ( ! get_theme_mod( 'penci_show_cookie_law' ) ) : ?>
                        <a class="penci-gdrd-show" aria-label="GDRD Show" href="#"><?php echo $penci_gprd_text; ?></a>
					<?php endif; ?>
                </div>

			<?php
			endif;
			if ( get_theme_mod( 'penci_tblogin' ) ) {
				penci_soledad_login_register_popup();
			}
			if ( get_theme_mod( 'penci_footer_analytics' ) ) :
				echo get_theme_mod( 'penci_footer_analytics' );
			endif;
		}
	},
	0
);

add_filter(
	'post_link',
	function ( $permalink, $post ) {
		$id = $post;
		if ( is_object( $post ) ) {
			$id = $post->ID;
		}

		$enable   = get_post_meta( $id, 'penci_sponsored_post', true );
		$url      = get_post_meta( $id, 'penci_sponsored_url', true );
		$redirect = get_post_meta( $id, 'penci_sponsored_redirect', true );
		if ( $enable && $url && $redirect && ! is_admin() ) {
			$permalink = $url . '" target="_blank';
		}

		return $permalink;
	},
	10,
	2
);

add_filter(
	'clean_url',
	function ( $good_protocol_url, $original_url, $_context ) {
		$id = get_the_ID();
		if ( $id ) {
			$enable   = get_post_meta( $id, 'penci_sponsored_post', true );
			$url      = get_post_meta( $id, 'penci_sponsored_url', true );
			$redirect = get_post_meta( $id, 'penci_sponsored_redirect', true );

			if ( $enable && $url && $redirect && ! is_admin() ) {
				$good_protocol_url = $original_url;
			}
		}

		return $good_protocol_url;
	},
	10,
	3
);

add_action(
	'penci_before_title',
	function () {
		$post_id = get_the_ID();
		$enable  = get_post_meta( $post_id, 'penci_sponsored_post', true );
		$mod     = get_theme_mod( 'penci_sponsored_prefix', true );
		if ( $enable && $mod && ! is_admin() ) {
			echo '<span class="penci-sponsored-label">' . penci_get_setting( 'penci_trans_sponsored' ) . '</span>';
		}
	}
);

add_filter(
	'the_title',
	function ( $post_title, $post_id ) {
		$enable = get_post_meta( $post_id, 'penci_sponsored_post', true );
		$mod    = get_theme_mod( 'penci_sponsored_prefix', true );
		if ( $enable && $mod && ! is_admin() ) {
			$post_title = '<span data-text="' . penci_get_setting( 'penci_trans_sponsored' ) . '" class="penci-sponsored-label"></span>' . $post_title;
		}

		return $post_title;
	},
	10,
	2
);

add_action(
	'penci_single_meta_content',
	function () {
		$id     = get_the_ID();
		$enable = get_post_meta( $id, 'penci_sponsored_post', true );
		$slogo  = get_post_meta( $id, 'penci_sponsored_logo', true );
		$surl   = get_post_meta( $id, 'penci_sponsored_url', true );

		$before = $after = '';
		if ( $surl ) {
			$before = '<a href="' . esc_url( $surl ) . '" target="_blank">';
			$after  = '</a>';
		}
		if ( $enable && ! empty( $slogo ) && isset( $slogo[0] ) ) {

			$img_size = wp_get_attachment_image_src( $slogo[0], 'penci-masonry-thumb' );
			$img_url  = isset( $img_size[0] ) ? $img_size[0] : '';
			$img_w    = isset( $img_size[1] ) ? $img_size[1] : '';
			$img_h    = isset( $img_size[2] ) ? $img_size[2] : '';

			$img_src = 'src="' . penci_holder_image_base( $img_w, $img_h ) . '" class="penci-lazy" data-src="' . $img_url . '"';

			if ( get_theme_mod( 'penci_disable_lazyload_layout' ) ) {
				$img_src = 'src="' . $img_url . '"';
			}

			echo '<span class="penci-sponsored-logo">' . penci_get_setting( 'penci_trans_sponsored_by' ) . $before . '<img width="' . $img_w . '" height="' . $img_h . '" ' . $img_src . ' alt="Sponsored Image">' . $after . '</span>';
		}
	}
);

if ( ! function_exists( 'penci_get_heading_style' ) ) {
	function penci_get_heading_style() {

		$css_class = '';

		$h1_style = get_theme_mod( 'penci_heading_h1_style' );
		$h2_style = get_theme_mod( 'penci_heading_h2_style' );
		$h3_style = get_theme_mod( 'penci_heading_h3_style' );
		$h4_style = get_theme_mod( 'penci_heading_h4_style' );
		$h5_style = get_theme_mod( 'penci_heading_h5_style' );

		if ( $h1_style ) {
			$css_class .= ' heading1-' . $h1_style;
		}

		if ( $h2_style ) {
			$css_class .= ' heading2-' . $h2_style;
		}

		if ( $h3_style ) {
			$css_class .= ' heading3-' . $h3_style;
		}

		if ( $h4_style ) {
			$css_class .= ' heading4-' . $h4_style;
		}

		if ( $h5_style ) {
			$css_class .= ' heading5-' . $h5_style;
		}

		return $css_class;
	}
}

if ( ! function_exists( 'penci_rtl_carousel_fix' ) ) {
	function penci_rtl_carousel_fix( $value ) {
		if ( is_rtl() ) {
			$value = '';
		}

		return $value;
	}

	add_filter( 'theme_mod_penci_carousel_slider_effect', 'penci_rtl_carousel_fix' );
	add_filter( 'theme_mod_penci_fslider_carousel_slider_effect', 'penci_rtl_carousel_fix' );
}


add_filter(
	'wp_trim_words',
	function ( $text, $num_words, $more, $original_text ) {
		$sponsored_text = penci_get_setting( 'penci_trans_sponsored' );
		$post_title     = wp_strip_all_tags( get_the_title() );
		$original_text  = wp_strip_all_tags( $original_text );
		if ( $post_title == $original_text && substr( $text, 0, strlen( $sponsored_text ) ) === $sponsored_text ) {
			$text = str_replace( $sponsored_text, '', $text );
			$text = '<span data-text="' . penci_get_setting( 'penci_trans_sponsored' ) . '" class="penci-sponsored-label pcfrpl"></span>' . $text;
		}

		return $text;
	},
	90,
	4
);


if ( ! function_exists( 'get_default_term_thumb_url' ) ) {
	function get_default_term_thumb_url( $term_id, $thumbnail = 'thumbnail', $show_default = true ) {

		$tag      = get_term( $term_id );
		$tax_data = get_taxonomy( $tag->taxonomy );

		if ( $tax_data->name == 'category' ) {
			$option_name = 'category_' . $term_id;
		} else {
			$option_name = 'penci_tax_' . $tax_data->name . '_' . $term_id;
		}

		$cat_image_data = get_option( $option_name );
		$default_url    = PENCI_SOLEDAD_URL . '/images/no-image2.jpg';
		$image_url      = isset( $cat_image_data['thumbnail_id'] ) && wp_get_attachment_image_url( $cat_image_data['thumbnail_id'], $thumbnail ) ? wp_get_attachment_image_url( $cat_image_data['thumbnail_id'], $thumbnail ) : '';

		if ( $show_default && ! $image_url ) {

			$term_data = get_term( $term_id );
			$tax_name  = $term_data->taxonomy;

			$term_query = new \WP_Query(
				array(
					'tax_query'      => array(
						array(
							'taxonomy' => $tax_name,
							'terms'    => $term_id,
						),
					),
					'posts_per_page' => 1,
					'meta_query'     => array(
						'key'     => '_thumbnail_id',
						'compare' => 'EXISTS',
					),
				)
			);

			if ( $term_query->have_posts() ) {
				while ( $term_query->have_posts() ) {
					$term_query->the_post();

					$image_url = get_the_post_thumbnail_url( get_the_ID(), $thumbnail );

				}
				wp_reset_postdata();
			}
		}

		return $image_url ? $image_url : $default_url;
	}
}


add_action(
	'penci_bookmark_post',
	function () {
		$id          = get_the_ID();
		$enable      = get_post_meta( $id, 'penci_video_preview', true );
		$preview_url = get_post_meta( $id, 'penci_video_preview_url', true );
		if ( $enable && $preview_url ) {
			$url = penci_get_video_url( $preview_url );
			echo '<div data-type="' . esc_url( $url['type'] ) . '" data-url="' . esc_url( $url['url'] ) . '" class="penci-preview-thumb"></div>';
		}
	}
);

if ( ! function_exists( 'penci_get_video_url' ) ) {
	function penci_get_video_url( $url ) {
		// This is a general function for generating an embed link of an FB/Vimeo/Youtube Video.
		$finalUrl = $url;
		$type     = 'self';
		if ( strpos( $url, 'facebook.com/' ) !== false ) {
			// it is FB video
			$finalUrl = 'https://www.facebook.com/plugins/video.php?href=' . rawurlencode( $url ) . '&show_text=1&width=200';
			$type     = 'facebook';
		} elseif ( strpos( $url, 'vimeo.com/' ) !== false ) {
			// it is Vimeo video
			$videoId = explode( 'vimeo.com/', $url )[1];
			if ( strpos( $videoId, '&' ) !== false ) {
				$videoId = explode( '&', $videoId )[0];
			}
			$finalUrl = 'https://player.vimeo.com/video/' . $videoId . '?autoplay=1&loop=1&title=0&byline=0&portrait=0&muted=1&background=1';
			$type     = 'vimeo';
		} elseif ( strpos( $url, 'youtube.com/' ) !== false ) {
			// it is Youtube video
			$videoId = explode( 'v=', $url )[1];
			if ( strpos( $videoId, '&' ) !== false ) {
				$videoId = explode( '&', $videoId )[0];
			}
			$finalUrl = 'https://www.youtube.com/embed/' . $videoId . '?&autoplay=1&mute=1&controls=0&loop=1';
			$type     = 'youtube';
		} elseif ( strpos( $url, 'youtu.be/' ) !== false ) {
			// it is Youtube video
			$videoId = explode( 'youtu.be/', $url )[1];
			if ( strpos( $videoId, '&' ) !== false ) {
				$videoId = explode( '&', $videoId )[0];
			}
			$type     = 'youtube';
			$finalUrl = 'https://www.youtube.com/embed/' . $videoId . '?&autoplay=1&mute=1&controls=0&loop=1';
		}

		return array(
			'url'  => $finalUrl,
			'type' => $type,
		);
	}
}

if ( ! function_exists( 'penci_menu_childs' ) ) {
	function penci_menu_childs( $items, $id ) {
		$child_items = array();
		foreach ( $items as $key => $child ) {
			if ( $child->menu_item_parent == $id ) {
				$child_items[] = $child;
				penci_find_child_menu_items( $child->ID, $items, $child_items );
			}
		}

		return $child_items;
	}
}

if ( ! function_exists( 'penci_find_child_menu_items' ) ) {
	function penci_find_child_menu_items( $parentId, $items, &$child_items ) {
		foreach ( $items as $key => $item ) {
			if ( $item->menu_item_parent == $parentId ) {
				$child_items[] = $item;
				penci_find_child_menu_items( $item->ID, $items, $child_items );
			}
		}
	}
}

if ( ! function_exists( 'penci_menu_parent_id' ) ) {
	function penci_menu_parent_id( $items, $child_id ) {
		if ( ! $child_id ) {
			return 0;
		}

		return penci_menu_find_parent_id( $items, $child_id );
	}
}

if ( ! function_exists( 'penci_menu_find_parent_id' ) ) {
	function penci_menu_find_parent_id( $items, $child_id ) {
		foreach ( $items as $element ) {

			if ( $child_id == $element->ID ) {
				$ID = $element->menu_item_parent ? $element->menu_item_parent : $element->ID;

				while ( $ID != $element->ID ) {
					$element = penci_get_element_by_id( $items, $ID );
					if ( ! $element ) {
						break;
					}
					$ID = $element->menu_item_parent ? $element->menu_item_parent : $element->ID;
				}

				return $ID;
			}
		}

		return 0;
	}
}

if ( ! function_exists( 'penci_get_element_by_id' ) ) {
	function penci_get_element_by_id( $items, $id ) {
		foreach ( $items as $element ) {
			if ( $element->ID == $id ) {
				return $element;
			}
		}

		return null;
	}
}

if ( ! function_exists( 'penci_layout_bg' ) ) {
	function penci_layout_bg( $url, $lazy = '' ) {
		if ( get_theme_mod( 'penci_img_layouttag' ) ) {
			return;
		}
		$enable_lazy = true;

		if ( ! $lazy ) {
			$enable_lazy = ! get_theme_mod( 'penci_disable_lazyload_layout' );
		}

		if ( $enable_lazy ) {
			$img = ' data-bgset="' . $url . '"';
		} else {
			preg_match( '/\bhttps?:\/\/\S+?\.(?:jpg|jpeg|gif|png|webp)\b/i', $url, $matches );
			$imageUrl = isset( $matches[0] ) ? $matches[0] : get_the_post_thumbnail_url( get_the_ID(), penci_featured_images_size() );
			$img      = ' style="background-image:url(' . $imageUrl . ')"';
		}

		return $img;
	}
}

if ( ! function_exists( 'penci_layout_bg_class' ) ) {
	function penci_layout_bg_class( $lazy = '' ) {
		if ( get_theme_mod( 'penci_img_layouttag' ) ) {
			return false;
		}
		$enable_lazy = true;

		if ( ! $lazy ) {
			$enable_lazy = ! get_theme_mod( 'penci_disable_lazyload_layout' );
		}

		if ( $enable_lazy ) {
			$img = 'penci-lazy';
		} else {
			$img = 'penci-no-lazy';
		}

		return $img;
	}
}

if ( ! function_exists( 'penci_layout_img' ) ) {
	function penci_layout_img( $url, $title = '', $lazy = '' ) {
		if ( ! get_theme_mod( 'penci_img_layouttag' ) ) {
			return false;
		}
		$enable_lazy = true;


		if ( ! $lazy ) {
			$enable_lazy = ! get_theme_mod( 'penci_disable_lazyload_layout' );
		}

		if ( $enable_lazy ) {
			$img = '<img class="penci-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="' . $url . '" alt="' . esc_attr( wp_strip_all_tags( $title ) ) . '"/>';
		} else {
			$img = '<img class="penci-dis-lazy" src="' . $url . '" alt="' . esc_attr( wp_strip_all_tags( $title ) ) . '"/>';
		}

		return $img;
	}
}

if ( ! function_exists( 'penci_cat_header_layout_builder' ) ) {
	add_filter( 'theme_mod_pchdbd_all', 'penci_cat_header_layout_builder', 999 );
	add_filter( 'theme_mod_pchdbd_archive', 'penci_cat_header_layout_builder', 999 );
	function penci_cat_header_layout_builder( $value ) {
		if ( is_category() || is_tax() || is_tag() ) {
			$term_id          = is_category() ? get_query_var( 'cat' ) : get_queried_object_id();
			$option_name      = is_category() ? "category_$term_id" : 'penci_tax_' . $term_id;
			$category_options = get_option( $option_name );

			if ( isset( $category_options['cat_header_builder'] ) && $category_options['cat_header_builder'] ) {
				return $category_options['cat_header_builder'];
			}

			if ( isset( $category_options['cat_header'] ) && $category_options['cat_header'] &&
			     ( ! isset( $category_options['cat_header_builder'] ) || $category_options['cat_header_builder'] == '' ) ) {
				return '';
			}
		}

		return $value;
	}
}

if ( ! function_exists( 'penci_get_cat_data' ) ) {
	function penci_get_cat_data( $option, $default ) {
		if ( is_category() || is_tax() || is_tag() ) {
			$term_id          = is_category() ? get_query_var( 'cat' ) : get_queried_object_id();
			$option_name      = is_category() ? "category_$term_id" : 'penci_tax_' . $term_id;
			$category_options = get_option( $option_name );

			if ( isset( $category_options[ $option ] ) && $category_options[ $option ] ) {
				return $category_options[ $option ];
			}
		}

		return $default;
	}
}

$pc_category_filters = array(
	'theme_mod_penci_header_layout'      => 'cat_header',
	'theme_mod_penci_color_accent'       => 'penci_archive_acolor',
	'theme_mod_penci_general_text_color' => 'penci_archive_gtextcolor',
	'theme_mod_penci_bg_color_dark'      => 'penci_archive_cbgcolor',
	'theme_mod_penci_border_color_dark'  => 'penci_archive_bdcolor',
);

foreach ( $pc_category_filters as $mod => $option ) {
	add_filter( $mod, function ( $value ) use ( $option ) {
		return penci_get_cat_data( $option, $value );
	}, 999 );
}

add_action( 'penci_sub_cat_list', function () {
	if ( is_category() && get_theme_mod( 'penci_archive_show_sub' ) ) {
		$current_cat_id = get_queried_object_id();
		$childs         = get_terms( [
			'taxonomy' => get_queried_object()->taxonomy,
			'parent'   => $current_cat_id,
		] );
		if ( ! empty ( $childs ) ) {

			?>

            <div class="categories-block pc-cat-archive">

                <ul class="cat-archive-list">
					<?php

					foreach ( $childs as $cat ) {

						$cat_class    = array( 'cat-block-' . $cat->term_id );
						$penci_cat_bg = get_default_term_thumb_url( $cat->term_id, 'penci-masonry-thumb' );
						$cat_bg       = '';
						if ( $penci_cat_bg ) {
							$cat_class[] = 'has-bg';
							$cat_class[] = penci_layout_bg_class();
							$cat_bg      = penci_layout_bg( $penci_cat_bg );
						}
						?>

                        <li <?php echo $cat_bg; ?> class="<?php echo join( ' ', $cat_class ) ?>">

                            <a href="<?php echo get_category_link( $cat->term_id ) ?>">
                                <h4 class="category-title"><?php echo esc_html( $cat->name ) ?></h4>
                                <span class="category-count"><?php echo esc_html( $cat->count ) ?></span>
                            </a>

                        </li>

						<?php
					}
					?>
                </ul>
            </div>

			<?php
		}
	}
} );

add_action( 'wp_ajax_penci_mtp_getdata', 'penci_mtp_getdata' );
add_action( 'wp_ajax_nopriv_penci_mtp_getdata', 'penci_mtp_getdata' );
function penci_mtp_getdata() {
	check_ajax_referer( 'penci-mtp-filters', 'nonce' );
	$paged     = wp_unslash( $_POST['paged'] );
	$tax       = wp_unslash( $_POST['tax'] );
	$ids       = wp_unslash( $_POST['ids'] );
	$query     = wp_unslash( $_POST['query'] );
	$settings  = wp_unslash( $_POST['settings'] );
	$post_args = json_decode( $query, true );
	$settings  = json_decode( $settings, true );
	if ( $ids ) {
		unset( $post_args['tax_query'] );
		$ids                      = explode( '|', $ids );
		$post_args['tax_query'][] = [
			'operator' => 'IN',
			'taxonomy' => $tax,
			'terms'    => $ids,
		];
	}
	$post_args['paged'] = $paged;
	$post_list          = new WP_Query( $post_args );

	ob_start();

	if ( $post_list->have_posts() ) {
		while ( $post_list->have_posts() ) {
			$post_list->the_post();
			?>
            <div class="pcsl-item<?php if ( 'yes' == $settings['hide_thumb'] || ! has_post_thumbnail() ) {
				echo ' pcsl-nothumb';
			} ?>">
                <div class="pcsl-itemin">
                    <div class="pcsl-iteminer">


						<?php if ( 'yes' != $settings['hide_thumb'] && has_post_thumbnail() ) { ?>
                            <div class="pcsl-thumb">
								<?php
								do_action( 'penci_bookmark_post', get_the_ID(), 'small' );
								/* Display Review Piechart  */
								if ( 'yes' == $settings['show_reviewpie'] && function_exists( 'penci_display_piechart_review_html' ) ) {
									penci_display_piechart_review_html( get_the_ID(), 'small' );
								}
								?>
								<?php if ( 'yes' == $settings['show_formaticon'] ): ?>
									<?php if ( has_post_format( 'video' ) ) : ?>
                                        <a href="<?php the_permalink() ?>"
                                           class="icon-post-format"
                                           aria-label="Icon"><?php penci_fawesome_icon( 'fas fa-play' ); ?></a>
									<?php endif; ?>
									<?php if ( has_post_format( 'gallery' ) ) : ?>
                                        <a href="<?php the_permalink() ?>"
                                           class="icon-post-format"
                                           aria-label="Icon"><?php penci_fawesome_icon( 'far fa-image' ); ?></a>
									<?php endif; ?>
									<?php if ( has_post_format( 'audio' ) ) : ?>
                                        <a href="<?php the_permalink() ?>"
                                           class="icon-post-format"
                                           aria-label="Icon"><?php penci_fawesome_icon( 'fas fa-music' ); ?></a>
									<?php endif; ?>
									<?php if ( has_post_format( 'link' ) ) : ?>
                                        <a href="<?php the_permalink() ?>"
                                           class="icon-post-format"
                                           aria-label="Icon"><?php penci_fawesome_icon( 'fas fa-link' ); ?></a>
									<?php endif; ?>
									<?php if ( has_post_format( 'quote' ) ) : ?>
                                        <a href="<?php the_permalink() ?>"
                                           class="icon-post-format"
                                           aria-label="Icon"><?php penci_fawesome_icon( 'fas fa-quote-left' ); ?></a>
									<?php endif; ?>
								<?php endif; ?>
                                <a <?php echo penci_layout_bg( penci_get_featured_image_size( get_the_ID(), $settings['thumbnail'] ), 'yes' != $settings['disable_lazy'] ); ?>
                                        href="<?php the_permalink(); ?>"
                                        title="<?php echo wp_strip_all_tags( get_the_title() ); ?>"
                                        class="<?php echo penci_layout_bg_class( 'yes' != $settings['disable_lazy'] ); ?> penci-image-holder"<?php if ( 'yes' == $settings['nocrop'] ) {
									echo ' style="padding-bottom: ' . penci_get_featured_image_padding_markup( get_the_ID(), $settings['thumbnail'], true ) . '%"';
								} ?>>
									<?php echo penci_layout_img( penci_get_featured_image_size( get_the_ID(), $settings['thumbnail'] ), get_the_title(), 'yes' != $settings['disable_lazy'] ); ?>
                                </a>

                            </div>
						<?php } ?>
                        <div class="pcsl-content">
							<?php if ( in_array( 'cat', $settings['post_meta'] ) ) : ?>
                                <div class="cat pcsl-cat">
									<?php penci_category( '', $settings['primary_cat'] ); ?>
                                </div>
							<?php endif; ?>

							<?php if ( in_array( 'title', $settings['post_meta'] ) ) : ?>
                                <div class="pcsl-title">
                                    <a href="<?php the_permalink(); ?>"<?php if ( $settings['title_length'] ): echo ' title="' . wp_strip_all_tags( get_the_title() ) . '"'; endif; ?>><?php

										if ( ! $settings['title_length'] ) {
											the_title();
										} else {
											echo wp_trim_words( wp_strip_all_tags( get_the_title() ), $settings['title_length'], '...' );
										} ?></a>
                                </div>
							<?php endif; ?>

							<?php if ( isset( $settings['cspost_enable'] ) && $settings['cspost_enable'] || ( count( array_intersect( array(
										'author',
										'date',
										'comment',
										'views',
										'reading'
									), $settings['post_meta'] ) ) > 0 ) || ( count( array_intersect( array(
										'author',
										'comment',
										'views',
										'reading'
									), $settings['post_meta'] ) ) > 0 ) ) { ?>

								<?php if ( $settings['column'] == 1 ) { ?>
                                    <div class="grid-post-box-meta pcsl-meta pcmtf-mt-alt">
										<?php if ( in_array( 'date', $settings['post_meta'] ) ) : ?>
                                            <span class="sl-date"><?php penci_soledad_time_link( null, $settings['dformat'] ); ?></span>
										<?php endif; ?>
                                    </div>
								<?php } ?>

                                <div class="grid-post-box-meta pcsl-meta">
									<?php if ( in_array( 'author', $settings['post_meta'] ) ) : ?>
                                        <span class="sl-date-author author-italic">
													<?php echo penci_get_setting( 'penci_trans_by' ); ?> <?php if ( function_exists( 'coauthors_posts_links' ) ) :
												penci_coauthors_posts_links();
											else: ?>
                                                <a class="author-url url fn n"
                                                   href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a>
											<?php endif; ?>
													</span>
									<?php endif; ?>
									<?php if ( in_array( 'date', $settings['post_meta'] ) && $settings['column'] > 1 ) : ?>
                                        <span class="sl-date"><?php penci_soledad_time_link( null, $settings['dformat'] ); ?></span>
									<?php endif; ?>
									<?php if ( in_array( 'comment', $settings['post_meta'] ) ) : ?>
                                        <span class="sl-comment">
												<a href="<?php comments_link(); ?> "><?php comments_number( '0 ' . penci_get_setting( 'penci_trans_comment' ), '1 ' . penci_get_setting( 'penci_trans_comment' ), '% ' . penci_get_setting( 'penci_trans_comments' ) ); ?></a>
											</span>
									<?php endif; ?>
									<?php
									if ( in_array( 'views', $settings['post_meta'] ) ) {
										echo '<span class="sl-views">';
										echo penci_get_post_views( get_the_ID() );
										echo ' ' . penci_get_setting( 'penci_trans_countviews' );
										echo '</span>';
									}
									?>
									<?php
									$hide_readtime = in_array( 'reading', $settings['post_meta'] ) ? false : true;
									if ( penci_isshow_reading_time( $hide_readtime ) ): ?>
                                        <span class="sl-readtime"><?php penci_reading_time(); ?></span>
									<?php endif; ?>
									<?php echo penci_show_custom_meta_fields( [
										'validator' => isset( $settings['cspost_enable'] ) ? $settings['cspost_enable'] : '',
										'keys'      => isset( $settings['cspost_cpost_meta'] ) ? $settings['cspost_cpost_meta'] : '',
										'acf'       => isset( $settings['cspost_cpost_acf_meta'] ) ? $settings['cspost_cpost_acf_meta'] : '',
										'label'     => isset( $settings['cspost_cpost_meta_label'] ) ? $settings['cspost_cpost_meta_label'] : '',
										'divider'   => isset( $settings['cspost_cpost_meta_divider'] ) ? $settings['cspost_cpost_meta_divider'] : '',
									] ); ?>
                                </div>
							<?php } ?>

							<?php if ( 'yes' == $settings['show_excerpt'] && 'side' == $settings['excerpt_pos'] ) { ?>
                                <div class="pcbg-pexcerpt pcsl-pexcerpt">
									<?php penci_the_excerpt( $settings['excerpt_length'] ); ?>
                                </div>
							<?php } ?>
							<?php if ( 'yes' == $settings['show_readmore'] && 'side' == $settings['excerpt_pos'] ) { ?>
                                <div class="pcsl-readmore">
                                    <a href="<?php the_permalink(); ?>"
                                       class="pcsl-readmorebtn pcsl-btns-<?php echo $settings['rmstyle']; ?>">
										<?php echo penci_get_setting( 'penci_trans_read_more' ); ?>
                                    </a>
                                </div>
							<?php } ?>

                        </div>

						<?php if ( ( 'yes' == $settings['show_excerpt'] || 'yes' == $settings['show_readmore'] ) && 'below' == $settings['excerpt_pos'] ) { ?>
                            <div class="pcsl-flex-full">
								<?php if ( 'yes' == $settings['show_excerpt'] ) { ?>
                                    <div class="pcbg-pexcerpt pcsl-pexcerpt">
										<?php penci_the_excerpt( $settings['excerpt_length'] ); ?>
                                    </div>
								<?php } ?>
								<?php if ( 'yes' == $settings['show_readmore'] ) { ?>
                                    <div class="pcsl-readmore">
                                        <a href="<?php the_permalink(); ?>"
                                           class="pcsl-readmorebtn pcsl-btns-<?php echo $settings['rmstyle']; ?>">
											<?php echo penci_get_setting( 'penci_trans_read_more' ); ?>
                                        </a>
                                    </div>
								<?php } ?>
                            </div>
						<?php } ?>
                    </div>
                </div>
            </div>
			<?php
		}
		wp_reset_postdata();
	}
	$out = ob_get_clean();
	wp_send_json_success( [ 'html' => $out, 'paged' => $post_args['paged'] ] );
}

add_filter( 'body_class', function ( $classes ) {
	$class = get_theme_mod( 'penci_tags_style' );
	if ( $class ) {
		$classes[] = 'pcstyle-' . $class;
	}

	return $classes;
} );

add_action( 'penci_header_wrap', function () {
	echo get_theme_mod( 'penci_custom_code_after_header_tag' );
} );

add_filter( 'wp_generate_tag_cloud', function ( $tag_string ) {
	return preg_replace( '/style=("|\')(.*?)("|\')/', '', $tag_string );
}, 10, 1 );

if ( ! function_exists( 'penci_vernav_builder_content' ) ) {
	function penci_vernav_builder_content( $id = 'penci_moble_vertical_block' ) {
		$nav_builder_slug = get_theme_mod( $id );
		
		if ( ! $nav_builder_slug ) {
			return;
		}
		
		$content   = '';
		$nav_id = '';
		
		$nav_data = get_page_by_path( $nav_builder_slug, OBJECT, 'penci-block' );
		if ( isset( $nav_data->ID ) && $nav_data->ID ) {
			$nav_id = $nav_data->ID;
		}

		if ( $nav_id ) {
			$nav_content = get_post( $nav_id );

			if ( $nav_content ) {
				if ( did_action( 'elementor/loaded' ) && \Elementor\Plugin::$instance->documents->get( $nav_id )->is_built_with_elementor() ) {
					$content .= '<div class="pcfb-wrapper">';
					$content .= penci_get_elementor_content( $nav_id );
					$content .= '</div>';
				} else {
					$content .= '<div class="pcfb-wrapper js-composer-content">';
					$content .= do_shortcode( $nav_content->post_content );

					$shortcodes_custom_css = get_post_meta( $nav_id, '_wpb_shortcodes_custom_css', true );

					$content .= '<style data-type="vc_shortcodes-custom-css">';
					if ( ! empty( $shortcodes_custom_css ) ) {
						$content .= $shortcodes_custom_css;
					}
					$content .= '</style>';
					$content .= '</div>';
				}
			}
		}

		return $content;
	}
}
if ( ! function_exists( 'penci_add_support_table_responsive' ) ) {
	add_filter( 'the_content', 'penci_add_support_table_responsive', 100, 1 );
	function penci_add_support_table_responsive( $content ) {

		$pattern = '/(<table\b[^>]*>)(.*?)(<\/table>)/is';
		$replacement = '<div class="pcrstb-wrap">$1$2$3</div>';

		// Use preg_replace to search for the pattern and wrap the matched content
		$content = preg_replace($pattern, $replacement, $content);

		return $content;

	}
}