<?php
/*
 * Contact CTA Form
 * shortcode: [button color="red" url="#" buttontext="Click Here!"]
 */
function jt_cta_shortcode( $atts ) {
	extract(shortcode_atts(array(
		'color' => '',
		'url' => '',
		'buttontext' => ''
	), $atts));

	$button = '<a class="button color-' . esc_attr( $color ) . '" href="' . esc_url( $url ) . '">' . esc_attr( $buttontext ) . '</a>';
	return $button;
}
add_shortcode( 'button', 'jt_cta_shortcode' );



/*
 * Featured Project CTA Shortcode
 * Shortcode: [featured_project_CTAshortcode]
 */
function featured_project_CTA_shortcode() {

	$cta_download_html = '<div class="container-fluid bg-secondary p-5">';
		$cta_download_html .= '<div class="row">';
			$cta_download_html .= '<div class="col-12 text-center">';
				$cta_download_html .= '<h3 class="text-white">Want to learn more about my process?</h3>';
				$cta_download_html .= '<p class="h4 text-white mb-4">Contact me for a free consultation</p>';
				$cta_download_html .= '<a href="/contact/" class="btn btn-primary">Contact Me</a>';
			$cta_download_html .= '</div>';
		$cta_download_html .= '</div>';
	$cta_download_html .= '</div>';

	return $cta_download_html;
}
add_shortcode('featured_project_CTAshortcode', 'featured_project_CTA_shortcode');







/* START CTA SHORTCODES */

/*
 * Download CTA
 * shortcode: [cta-download cta_title="" cta_subtitle="" cta_content="" cta_link="" cta_button_text=""]
 */
function cta_download($atts){

	extract(
		shortcode_atts(
			array(
				'cta_title' => '',
				'cta_subtitle' => '',
				'cta_content' => '',
				'cta_link' => '',
				'cta_button_text' => ''
			), $atts
		)
	);

	$cta_download_html = "<div class='cta cta-download'>";
	$cta_download_html .= "<div class='cta-download-inner'>";
	$cta_download_html .= "<div class='ftf-col-1'>";
	if($cta_title !== '') {
		$cta_download_html .= "<h3 class='cta-title text-white'>$cta_title</h3>";
	} else {
		$cta_download_html .= "<h3 class='cta-title text-white'>Download Cribl LogStream. It's free to get started.</h3>";
	}

	if($cta_subtitle !== '') {
		$cta_download_html .= "<h4 class='cta-subtitle text-white'>$cta_subtitle</h4>";
	}

	if($cta_content !== '') {
		$cta_download_html .= "<p class='cta-paragraph text-white'>$cta_content</p>";
	} else {
		$cta_download_html .= "<p class='cta-paragraph text-white'>It's free to process <100 GB per day. Once you see the value and want to process more, let's talk. The free plan is single node and community supported.</p>";
	}
	$cta_download_html .= "</div>";



	if($cta_button_text !== '') {
		$cta_text_button = $cta_button_text;
	} else {
		$cta_text_button = "Download";
	}



	$cta_download_html .= "<div class='ftf-col-2'>";
	if($cta_link !== '') {
		$cta_download_html .= "<a class='button cta-button-1 has-shadow' href='$cta_link'>$cta_text_button</a>";
	} else {
		$cta_download_html .= "<a class='button cta-button-1 has-shadow' href='/download/'>$cta_text_button</a>";
	}
	$cta_download_html .= "</div>";
	$cta_download_html .= "</div>";
	$cta_download_html .= "</div>";

	return $cta_download_html;
}

add_shortcode('cta-download', 'cta_download');

/*
 * Contact CTA
 * shortcode: [cta-contact cta_heading="" cta_text="" cta_link=""]
 */
function cta_contact($atts){

	extract(
		shortcode_atts(
			array(
				'cta_heading' => '',
				'cta_text' => '',
				'cta_link' => ''
			), $atts
		)
	);

	$cta_contact_html = "<div class='cta cta-contact text-center'>";

	if($cta_heading !== '') {
		$cta_contact_html .= "<h3 class='cta-title text-white'>$cta_heading</h3>";
	} else {
		$cta_contact_html .= "<h3 class='cta-title text-white'>Contact Us</h3>";
	}

	if($cta_text !== '') {
		$cta_contact_html .= "<p class='cta-paragraph text-white'>$cta_text</p>";
	} else {
		$cta_contact_html .= "<p class='cta-paragraph text-white'>We’d love to hear from you! Tell us about your use case. Ask us about a license.</p>";
	}

	if($cta_link !== '') {
		$cta_contact_html .= "<a class='button cta-button-2 has-shadow' href='$cta_link'>Contact Us</a>";
	} else {
		$cta_contact_html .= "<a class='button cta-button-2 has-shadow' href='/contact/'>Contact Us</a>";
	}

	$cta_contact_html .= "</div>";

	return $cta_contact_html;
}

add_shortcode('cta-contact', 'cta_contact');

/*
 * Contact CTA Form
 * shortcode: [cta-contact-form cta_class="" cta_link=""]
 */
function cta_contact_form($atts){

	extract(
		shortcode_atts(
			array(
				'cta_class' => '',
				'cta_link' => ''
			), $atts
		)
	);

	$cta_contact_form = "<div class='cta cta-contact-form'>";
	$cta_contact_form.= "<div id='cta-contact-form-content-wrapper' class='cta-contact-form-wrapper'>";
	if($cta_class !== '' && $cta_link !== '') {
		$cta_contact_form .= "<div class=\"$cta_class\"></div><script src=\"$cta_link\" type=\"text/javascript\" charset=\"utf-8\"></script>";
	} else {
		$cta_contact_form .= "<div class=\"_form_5\"></div><script src=\"https://cribl.activehosted.com/f/embed.php?id=5\" type=\"text/javascript\" charset=\"utf-8\"></script>";
	}
	$cta_contact_form .= "</div>";
	$cta_contact_form .= "</div>";

	return $cta_contact_form;
}

add_shortcode('cta-contact-form', 'cta_contact_form');

/*
 * Community CTA
 * shortcode: [cta-community cta_heading="" cta_text="" cta_link=""]
 */
function cta_community($atts){

	extract(
		shortcode_atts(
			array(
				'cta_heading' => '',
				'cta_text' => '',
				'cta_link' => ''
			), $atts
		)
	);

	$cta_community_html = "<div class='cta cta-community text-center'>";

	if($cta_heading !== '') {
		$cta_community_html .= "<h3 class='cta-title'>$cta_heading</h3>";
	} else {
		$cta_community_html .= "<h3 class='cta-title'>Join the Community!</h3>";
	}

	if($cta_text !== '') {
		$cta_community_html .= "<p class='cta-paragraph'>$cta_text</p>";
	} else {
		$cta_community_html .= "<p class='cta-paragraph'>The Cribl community on Slack is a great place to get real time answers! Our co-founders, employees, partners and other users are here for you.</p>";
	}

	if($cta_link !== '') {
		$cta_community_html .= "<a class='cta-button' href='$cta_link'>Join the Community</a>";
	} else {
		$cta_community_html .= "<a class='button cta-button-1' href='/community/'>Join the Community</a>";
	}

	$cta_community_html .= "</div>";

	return $cta_community_html;
}

add_shortcode('cta-community', 'cta_community');

/*
 * Clibl U CTA
 * shortcode: [cta-criblu cta_class="" cta_link=""]
 */
function cta_criblu($atts){

	extract(
		shortcode_atts(
			array(
				'cta_class' => '',
				'cta_link' => ''
			), $atts
		)
	);

	$cta_criblu_html = "<div class='cta cta-criblu'>";
	$cta_criblu_html.= "<div id='cta-criblu-content-wrapper' class='cta-criblu-wrapper'>";
	if($cta_class !== '' && $cta_link !== '') {
		$cta_criblu_html .= "<div class=\"$cta_class\"></div><script src=\"$cta_link\" type=\"text/javascript\" charset=\"utf-8\"></script>";
	} else {
		$cta_criblu_html .= "<div class=\"_form_3\"></div><script src=\"https://cribl.activehosted.com/f/embed.php?id=3\" type=\"text/javascript\" charset=\"utf-8\"></script>";
	}
	$cta_criblu_html .= "</div>";
	$cta_criblu_html .= "</div>";

	return $cta_criblu_html;
}

add_shortcode('cta-criblu', 'cta_criblu');

/* END CTA SHORTCODES */