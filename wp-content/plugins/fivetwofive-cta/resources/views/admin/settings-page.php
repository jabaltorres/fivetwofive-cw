<?php
/**
 * The Call To Action page content.
 *
 * @link       https://fivetwofive.com/
 * @since      1.0.0
 *
 * @package    FiveTwoFive
 * @subpackage FiveTwoFive/resources/views/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// check user capabilities.
if ( ! current_user_can( 'manage_options' ) ) {
	return;
}

// check if the user have submitted the settings.
// WordPress will add the "settings-updated" $_GET parameter to the url.
if ( isset( $_GET['settings-updated'] ) ) {
	// add settings saved message with the class of "updated".
	add_settings_error( 'fivetwofive_cta_messages', 'fivetwofive_cta_message', __( 'Settings Saved', 'fivetwofive-cta' ), 'updated' );
}

// show error/update messages.
settings_errors( 'fivetwofive_cta_messages' );

?>

<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<form action="options.php" method="post">
		<?php settings_fields( 'fivetwofive_cta' ); ?>

		<div id="ftfCtaTabs">
			<ul class="nav-tab-wrapper">
				<li style="margin: 0;"><a class="nav-tab nav-tab-active" href="#ftfCtaContent">Content</a></li>
				<li style="margin: 0;"><a class="nav-tab" href="#ftfCtaAppearance">Appearance</a></li>
			</ul>

			<div id="ftfCtaContent">
				<table class="form-table">
					<?php do_settings_fields( 'fivetwofive_cta', 'fivetwofive_cta_content_section' ); ?>
				</table>
			</div>

			<div id="ftfCtaAppearance">
				<table class="form-table">
					<?php do_settings_fields( 'fivetwofive_cta', 'fivetwofive_cta_appearance_section' ); ?>
				</table>
			</div>
		</div>

		<?php submit_button(); ?>
	</form>
</div>
