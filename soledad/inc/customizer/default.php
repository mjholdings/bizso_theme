<?php
/**
 * Set some values default when theme is activated
 *
 * @param string $name
 *
 * @return string / true / false
 */
if ( ! function_exists( 'penci_default_setting_customizer' ) ) {
	function penci_default_setting_customizer( $name ) {
		$defaults = array(

			// Options
			'penci_sidebar_home'                => true,
			'penci_sidebar_posts'               => true,
			'penci_sidebar_archive'             => true,
			'penci_preload_google_fonts'        => true,
			'penci_toppost_enable'              => true,
			'penci_tb_date_text'                => "[penci_date format='l, F j Y'] - Welcome",
			'penci_facebook'                    => 'https://www.facebook.com/PenciDesign',
			'penci_twitter'                     => 'https://twitter.com/PenciDesign',
			'penci_single_poslcscount'          => 'below-content',

			// Transition text
			'penci_top_bar_custom_text'         => esc_html__( 'Top Posts', 'soledad' ),
			'penci_header_slogan_text'          => esc_html__( 'keep your memories alive', 'soledad' ),
			'penci_trans_comment'               => esc_html__( 'comment', 'soledad' ),
			'penci_trans_countviews'            => esc_html__( 'views', 'soledad' ),
			'penci_trans_read'                  => esc_html__( 'read', 'soledad' ),
			'penci_trans_tago'                  => esc_html__( 'ago', 'soledad' ),
			'penci_trans_beforeago'             => '',
			'penci_trans_published'             => esc_html__( 'Published:', 'soledad' ),
			'penci_trans_modifiedat'            => esc_html__( 'Updated:', 'soledad' ),
			'penci_trans_save_fields'           => esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'soledad' ),
			'penci_trans_type_and_hit'          => esc_html__( 'Type and hit enter...', 'soledad' ),
			'penci_trans_comments'              => esc_html__( 'comments', 'soledad' ),
			'penci_trans_reply_comment'         => esc_html__( 'Reply', 'soledad' ),
			'penci_trans_edit_comment'          => esc_html__( 'Edit', 'soledad' ),
			'penci_trans_wait_approval_comment' => esc_html__( 'Your comment is awaiting approval', 'soledad' ),
			'penci_trans_by'                    => esc_html__( 'by', 'soledad' ),
			'penci_trans_home'                  => esc_html__( 'Home', 'soledad' ),
			'penci_home_popular_title'          => esc_html__( 'Popular Posts', 'soledad' ),
			'penci_home_title'                  => '',
			'penci_trans_newer_posts'           => esc_html__( 'Newer Posts', 'soledad' ),
			'penci_trans_older_posts'           => esc_html__( 'Older Posts', 'soledad' ),
			'penci_trans_load_more_posts'       => esc_html__( 'Load More Posts', 'soledad' ),
			'penci_trans_load_more_items'       => esc_html__( 'Load More Items', 'soledad' ),
			'penci_trans_load_more_comments'    => esc_html__( 'Load More Comments', 'soledad' ),
			'penci_trans_no_more_posts'         => esc_html__( 'Sorry, No more posts', 'soledad' ),
			'penci_trans_no_more_items'         => esc_html__( 'Sorry, No more items', 'soledad' ),
			'penci_trans_no_more_comments'      => esc_html__( 'Sorry, No more comments', 'soledad' ),
			'penci_trans_no_comments'           => esc_html__( 'Sorry, No comments found.', 'soledad' ),
			'penci_trans_all'                   => esc_html__( 'All', 'soledad' ),
			'penci_trans_close'                 => esc_html__( 'Close', 'soledad' ),
			'penci_trans_back_to_top'           => esc_html__( 'Back To Top', 'soledad' ),
			'penci_trans_written_by'            => esc_html__( 'written by', 'soledad' ),
			'penci_trans_updated_by'            => esc_html__( 'Updated by', 'soledad' ),
			'penci_trans_reviewed_by'           => esc_html__( 'Reviewed by', 'soledad' ),
			'penci_trans_edited_by'             => esc_html__( 'Edited by', 'soledad' ),
			'penci_trans_revised_by'            => esc_html__( 'Revised by', 'soledad' ),
			'penci_trans_previous_post'         => esc_html__( 'previous post', 'soledad' ),
			'penci_trans_next_post'             => esc_html__( 'next post', 'soledad' ),
			'penci_post_related_text'           => esc_html__( 'You may also like', 'soledad' ),
			'penci_inlinerp_title'              => esc_html__( 'You Might Be Interested In', 'soledad' ),
			'penci_trans_author_profile'        => __( 'Author Profile', 'soledad' ),
			'penci_trans_author_related'        => __( 'Posts by the Author', 'soledad' ),
			'penci_rltpopup_heading_text'       => esc_html__( 'Read also', 'soledad' ),
			'penci_trans_name'                  => esc_html__( 'Name*', 'soledad' ),
			'penci_trans_email'                 => esc_html__( 'Email*', 'soledad' ),
			'penci_trans_website'               => esc_html__( 'Website', 'soledad' ),
			'penci_trans_your_comment'          => esc_html__( 'Your Comment', 'soledad' ),
			'penci_trans_leave_a_comment'       => esc_html__( 'Leave a Comment', 'soledad' ),
			'penci_trans_cancel_reply'          => esc_html__( 'Cancel Reply', 'soledad' ),
			'penci_trans_submit'                => esc_html__( 'Submit', 'soledad' ),
			'penci_trans_category'              => esc_html__( 'Category:', 'soledad' ),
			'penci_trans_continue_reading'      => esc_html__( 'Continue Reading', 'soledad' ),
			'penci_trans_read_more'             => esc_html__( 'Read more', 'soledad' ),
			'penci_trans_view_all'              => esc_html__( 'View All', 'soledad' ),
			'penci_trans_tag'                   => esc_html__( 'Tag:', 'soledad' ),
			'penci_trans_tags'                  => esc_html__( 'Tags', 'soledad' ),
			'penci_trans_posts_tagged'          => esc_html__( 'Posts tagged with', 'soledad' ),
			'penci_trans_author'                => esc_html__( 'Author', 'soledad' ),
			'penci_trans_daily_archives'        => esc_html__( 'Daily Archives', 'soledad' ),
			'penci_trans_monthly_archives'      => esc_html__( 'Monthly Archives', 'soledad' ),
			'penci_trans_yearly_archives'       => esc_html__( 'Yearly Archives', 'soledad' ),
			'penci_trans_archives'              => esc_html__( 'Archives', 'soledad' ),
			'penci_trans_search'                => esc_html__( 'Search', 'soledad' ),
			'penci_trans_search_results_for'    => esc_html__( 'Search results for', 'soledad' ),
			'penci_trans_share'                 => esc_html__( 'Share', 'soledad' ),
			'penci_trans_comments_closed'       => esc_html__( 'Comments are closed.', 'soledad' ),
			'penci_trans_search_not_found'      => esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'soledad' ),
			'penci_trans_back_to_homepage'      => esc_html__( 'Back to Home Page', 'soledad' ),
			'penci_not_found_sub_heading'       => esc_html__( "OOPS! Page you're looking for doesn't exist. Please use search for help", 'soledad' ),
			'penci_footer_copyright'            => '@2021 - All Right Reserved. Designed and Developed by <a rel="nofollow" href="https://1.envato.market/YYJ4P" target="_blank">PenciDesign</a>',
			'penci_bg_color_dark'               => '#ffffff',
			'penci_text_color_dark'             => '#afafaf',
			'penci_border_color_dark'           => '#DEDEDE',
			'penci_meta_color_dark'             => '#949494',
			'penci_gprd_desc'                   => esc_html__( "This website uses cookies to improve your experience. We'll assume you're ok with this, but you can opt-out if you wish.", 'soledad' ),
			'penci_gprd_rmore'                  => esc_html__( 'Read More', 'soledad' ),
			'penci_gprd_btn_accept'             => esc_html__( 'Accept', 'soledad' ),
			'penci_gprd_policy_text'            => esc_html__( 'Privacy & Cookies Policy', 'soledad' ),
			'penci_trans_next'                  => esc_html__( 'Next', 'soledad' ),
			'penci_trans_back'                  => esc_html__( 'Back', 'soledad' ),
			'penci_trans_k_number'              => esc_html__( 'K', 'soledad' ),
			'penci_trans_m_number'              => esc_html__( 'M', 'soledad' ),
			'penci_gprd_rmore_link'             => '#',
			'penci_arf_title'                   => esc_html__( 'Latest in {name}', 'soledad' ),
			'penci_trans_noproductfount'        => esc_html__( 'No product found', 'soledad' ),
			'penci_trans_sku'                   => esc_html__( 'Sku', 'soledad' ),

			// Login & Register
			'penci_tblogin_text'                => '',
			'penci_trans_hello_text'            => esc_html__( 'Hello', 'soledad' ),
			'penci_trans_dashboard_text'        => esc_html__( 'Dashboard', 'soledad' ),
			'penci_trans_profile_text'          => esc_html__( 'Profile', 'soledad' ),
			'penci_trans_logout_text'           => esc_html__( 'Logout', 'soledad' ),
			'penci_trans_sign_in'               => esc_html__( 'Sign In', 'soledad' ),
			'penci_trans_register_new_account'  => esc_html__( 'Register New Account', 'soledad' ),
			'penci_trans_recover_pass'          => esc_html__( 'Password Recovery', 'soledad' ),
			'penci_plogin_wrong'                => esc_html__( 'Wrong username or password', 'soledad' ),
			'penci_plogin_success'              => esc_html__( 'Login successful, redirecting...', 'soledad' ),
			'penci_plogin_email_place'          => esc_html__( 'Email Address', 'soledad' ),
			'penci_trans_usernameemail_text'    => esc_html__( 'Username or email', 'soledad' ),
			'penci_trans_pass_text'             => esc_html__( 'Password', 'soledad' ),
			'penci_plogin_label_remember'       => esc_html__( 'Keep me signed in until I sign out', 'soledad' ),
			'penci_plogin_label_log_in'         => esc_html__( 'Login to your account', 'soledad' ),
			'penci_plogin_validate_robot'       => esc_html__( 'Please validate you are not robot.', 'soledad' ),
			'penci_plogin_label_lostpassword'   => esc_html__( 'Forgot your password?', 'soledad' ),
			'penci_plogin_text_has_account'     => esc_html__( 'Do not have an account ?', 'soledad' ),
			'penci_plogin_label_registration'   => esc_html__( 'Register here', 'soledad' ),

			'penci_preset_submit'         => esc_html__( 'Send My Password', 'soledad' ),
			'penci_preset_desc'           => esc_html__( 'A new password will be emailed to you.', 'soledad' ),
			'penci_preset_received'       => esc_html__( 'Have received a new password?', 'soledad' ),
			'penci_preset_noemail'        => esc_html__( 'There is no user registered with that email.', 'soledad' ),
			'penci_preset_from'           => esc_html__( 'From:', 'soledad' ),
			'penci_preset_newpassis'      => esc_html__( 'Your new password is:', 'soledad' ),
			'penci_preset_checkinbox'     => esc_html__( 'Check your email address to get the new password.', 'soledad' ),
			'penci_preset_cantsend'       => esc_html__( 'The email could not be sent. Possible reason: your host may have disabled the mail() function.', 'soledad' ),
			'penci_preset_somethingwrong' => esc_html__( 'Oops! Something went wrong while updating your account.', 'soledad' ),

			'penci_pregister_first_name'         => esc_html__( 'First Name', 'soledad' ),
			'penci_pregister_last_name'          => esc_html__( 'Last Name', 'soledad' ),
			'penci_pregister_display_name'       => esc_html__( 'Display Name', 'soledad' ),
			'penci_pregister_user_name'          => esc_html__( 'Username', 'soledad' ),
			'penci_pregister_user_email'         => esc_html__( 'Email address', 'soledad' ),
			'penci_pregister_user_pass'          => esc_html__( 'Password', 'soledad' ),
			'penci_pregister_pass_confirm'       => esc_html__( 'Confirm Password', 'soledad' ),
			'penci_pregister_button_submit'      => esc_html__( 'Sign up new account', 'soledad' ),
			'penci_pregister_has_account'        => esc_html__( 'Have an account?', 'soledad' ),
			'penci_pregister_label_registration' => esc_html__( 'Login here', 'soledad' ),
			'penci_pregister_cinfo' 			 => esc_html__( 'Contact Info', 'soledad' ),
			'penci_pregister_about' 			 => esc_html__( 'About Yourself', 'soledad' ),
			'penci_pregister_binfo' 			 => esc_html__( 'Biographical Info', 'soledad' ),
			'penci_pregister_picture' 			 => esc_html__( 'Profile Picture', 'soledad' ),

			'penci_plogin_mess_invalid_email'    => esc_html__( 'Invalid email.', 'soledad' ),
			'penci_plogin_mess_error_email_pass' => esc_html__( 'Password does not match the confirm password', 'soledad' ),
			'penci_plogin_mess_username_reg'     => esc_html__( 'This username is already registered.', 'soledad' ),
			'penci_plogin_mess_email_reg'        => esc_html__( 'This email address is already registered.', 'soledad' ),
			'penci_plogin_mess_wrong_email_pass' => esc_html__( 'Wrong username or password.', 'soledad' ),
			'penci_plogin_mess_reg_succ'         => esc_html__( 'Registered successful, redirecting...', 'soledad' ),

			'penci__hide_share_linkedin'    => 1,
			'penci__hide_share_tumblr'      => 1,
			'penci__hide_share_reddit'      => 1,
			'penci__hide_share_telegram'    => 1,
			'penci__hide_share_stumbleupon' => 1,
			'penci__hide_share_whatsapp'    => 1,
			'penci__hide_share_line'        => 1,
			'penci__hide_share_ok'          => 1,
			'penci__hide_share_vk'          => 1,
			'penci__hide_share_messenger'   => 1,
			'penci__hide_share_pocket'      => 1,
			'penci__hide_share_skype'       => 1,
			'penci__hide_share_viber'       => 1,

			'penci_ajaxsearch_no_post'   => esc_html__( 'No Post Found!', 'soledad' ),
			'penci_agepopup_agree_text'  => esc_html__( 'I am 18 or Older', 'soledad' ),
			'penci_agepopup_cancel_text' => esc_html__( 'I am Under 18', 'soledad' ),

			'penci_toc_heading_text' => esc_html__( 'Table of Contents', 'soledad' ),
			'penci_trans_recent'     => esc_html__( 'Recent', 'soledad' ),
			'penci_trans_popular'    => esc_html__( 'Popular', 'soledad' ),
			'penci_trans_post'       => esc_html__( 'Post', 'soledad' ),
			'penci_trans_posts'      => esc_html__( 'Posts', 'soledad' ),
			'penci_trans_followers'  => esc_html__( 'Followers', 'soledad' ),
			'penci_trans_follow'     => esc_html__( 'Follow', 'soledad' ),
			'penci_trans_following'  => esc_html__( 'Following', 'soledad' ),
			'penci_trans_likes'      => esc_html__( 'Likes', 'soledad' ),

			'penci_trans_sepproduct'         => esc_html__( 'Search for products', 'soledad' ),
			'penci_trans_sepproduct_desc'    => esc_html__( 'Start typing to see products you are looking for.', 'soledad' ),
			'penci_trans_sepproject'         => esc_html__( 'Search for projects.', 'soledad' ),
			'penci_trans_sepproject_desc'    => esc_html__( 'Start typing to see projects you are looking for.', 'soledad' ),
			'penci_trans_seppost'            => esc_html__( 'Search for posts', 'soledad' ),
			'penci_trans_seppost_desc'       => esc_html__( 'Start typing to see posts you are looking for.', 'soledad' ),
			'penci_trans_selectcat'          => esc_html__( 'Select category', 'soledad' ),
			'penci_trans_resfblog'           => esc_html__( 'Result form blog', 'soledad' ),
			'penci_trans_allresult'          => esc_html__( 'Show all results', 'soledad' ),
			'penci_trans_npostfound'         => esc_html__( 'No results', 'soledad' ),
			'penci_trans_my_account'         => __( 'My Account', 'soledad' ),
			'penci_trans_edit_account'       => __( 'Edit Account', 'soledad' ),
			'penci_trans_change_password'    => __( 'Change Password', 'soledad' ),
			'penci_trans_cimage'             => __( 'Choose Image', 'soledad' ),
			'penci_trans_admedia'            => __( 'Add Media', 'soledad' ),
			'penci_trans_insert'             => __( 'Insert', 'soledad' ),
			'penci_trans_oldpassword'        => __( 'Old Password', 'soledad' ),
			'penci_trans_newpassword'        => __( 'New Password', 'soledad' ),
			'penci_trans_cpassword'          => __( 'Confirm Password', 'soledad' ),
			'penci_trans_update_notice'      => __( 'You have successfully edited your account details', 'soledad' ),
			'penci_trans_password_not_valid' => __( 'Your old password is not valid', 'soledad' ),
			'penci_trans_password_new'       => __( 'Please enter your new password', 'soledad' ),
			'penci_trans_password_match'     => __( 'New Password & Confirm Password do not match', 'soledad' ),
			'penci_trans_password_success'   => __( 'You have successfully changed your password', 'soledad' ),
			'penci_trans_password_e'         => __( 'Please enter your old password', 'soledad' ),

			'penci_trans_minutes'           => esc_html__( 'minutes', 'soledad' ),
			'penci_trans_like_posts'        => __( 'Like Posts', 'soledad' ),
			'penci_adblocker_popup_message' => __( 'Please support us by disabling your AdBlocker extension from your browsers for our website.', 'soledad' ),
			'penci_adblocker_popup_title'   => __( 'Adblock Detected', 'soledad' ),
			'penci_adblocker_dissmiss'      => __( 'Dismiss this message', 'soledad' ),

			'penci_trans_showing_result' => __( 'Showing {{value}}-{{value}} of {{value}} post results', 'soledad' ),
			'penci_trans_sort_latest'    => __( 'Sort by latest', 'soledad' ),
			'penci_trans_sort_older'     => __( 'Sort by older', 'soledad' ),
			'penci_trans_no_content'     => __( 'No Content Available', 'soledad' ),

			'penci_overall_rating'     => __( 'Your rating:', 'soledad' ),
			'penci_summarize'          => __( 'Your review title', 'soledad' ),
			'penci_your_review'        => __( 'Your Review', 'soledad' ),
			'penci_review_desc'        => __( 'Tell about your experience or leave a tip for others', 'soledad' ),
			'penci_review_submit'      => __( 'Submit your Review', 'soledad' ),
			'penci_review_title'       => __( 'Review Title', 'soledad' ),
			'penci_review_ratings'     => __( 'Rating:', 'soledad' ),
			'penci_review_terrible'    => __( 'Terrible', 'soledad' ),
			'penci_review_poor'        => __( 'Poor', 'soledad' ),
			'penci_review_average'     => __( 'Average', 'soledad' ),
			'penci_review_verygood'    => __( 'Very Good', 'soledad' ),
			'penci_review_exceptional' => __( 'Exceptional', 'soledad' ),
			'penci_trans_bookmark'     => __( 'Bookmark', 'soledad' ),
			'penci_trans_reset'        => __( 'Reset', 'soledad' ),
			'penci_trans_a1'           => __( 'A+', 'soledad' ),
			'penci_trans_a2'           => __( 'A-', 'soledad' ),
			'penci_trans_sponsored'    => __( 'Sponsored', 'soledad' ),
			'penci_trans_sponsored_by' => __( 'Sponsored by:', 'soledad' ),
			'penci_trans_allow_ads'    => __( 'Allow Ads', 'soledad' ),

		);

		return isset( $defaults[ $name ] ) ? $defaults[ $name ] : '';
	}
}

/**
 * Get theme settings.
 *
 * @param string $name
 *
 * @since 4.0
 */
if ( ! function_exists( 'penci_get_setting' ) ) {
	function penci_get_setting( $name ) {
		return do_shortcode( get_theme_mod( $name, penci_default_setting_customizer( $name ) ) );
	}
}

if ( ! get_option( 'penci_loads_cm' ) ) {
	add_option( 'penci_loads_cm', 'load' );
}

if ( ! function_exists( 'penci_loads_cm' ) ) {
	function penci_loads_cm() {
		// set the array for testing the local environment
		$whitelist = array( '127.0.0.1', '::1' );

		// check if the server is in the array
		if ( in_array( $_SERVER['REMOTE_ADDR'], $whitelist ) ) {

			// this is a local environment
			return true;

		} else {
			return 'load' == get_option( 'penci_loads_cm' );
		}
	}
}