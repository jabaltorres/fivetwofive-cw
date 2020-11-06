<?php
	// url params
	if ( isset( $_GET['actn'] ) ) {
		$ulParam      = $_GET['actn'];
		$btnSubmitted = true;
		// echo "Button URL param IS set. Value is: " . $ulParam . "<br/>";
	} else {
		$btnSubmitted      = false;
		$defaultValueParam = "btnNotSubmitted";
		// Handle the case where there is no parameter
		// echo "Button URL param is NOT set. Defaul val: " . $defaultValueParam .  "<br/>";
	}

	// srcHiddenVal gets passed to the data-name='source_hidden hidden field - might not use
	$srcHiddenVal = "";

	// Gated Step 1
	$unG8dStep1 = "";
	if ( isset( $_GET['src'] ) ) {
		$srcURLParam = $_GET['src'];

		switch ( $srcURLParam ) {
			case 'external':
				$srcHiddenVal = "External";
				$unG8dStep1   = true;
				break;
			case 'CRIBL':
				$srcHiddenVal = "Cribl Form Tester";
				$unG8dStep1   = true;
				break;
			default:
				$srcHiddenVal = htmlspecialchars( "Other: src = " . $srcURLParam );
				$unG8dStep1   = false;
				break;
		}

		// echo $srcHiddenVal;
	}

	// Gated Step 2
	$unG8dStep2 = "";
	if ( isset( $_GET['ung8'] ) ) {
		$g8dURLParam = $_GET['ung8'];
		if ( $g8dURLParam == "1" ) {
			$unG8dStep2 = true;
		}
	}

	// Force Ungating
	$hardUngate = "";
	if ( $unG8dStep1 && $unG8dStep2 ) {
		$hardUngate = true;
	}

	//    if ( isset( $_GET['utm_source'] ) ) {
	//        $criblUtmSource = $_GET['utm_source'];
	//    }
	//    if ( isset( $_GET['utm_campaign'] ) ) {
	//        $criblUtmCampaign = $_GET['utm_campaign'];
	//    }
	//    if ( isset( $_GET['utm_medium'] ) ) {
	//        $criblUtmMedium = $_GET['utm_medium'];
	//    }


	// Pantheon requires this prefixed naming convention (STYXKEY) for setting cookies
	$cribl_cookie_name = "STYXKEY-cribl";
	$criblCookieSet = "";
	if ( isset( $_COOKIE[ $cribl_cookie_name ] ) ) {
		$criblCookieSet = true;
	} else {
		$criblCookieSet = false;
	}

	$assetUngated = "";
	if ($criblCookieSet || $hardUngate){
		$assetUngated = true;
	} else {
		$assetUngated = false;
	}


	$resource_type           = get_field('resource_type');
	$resource_file           = get_field( 'resource_file' );
	$vimeo_video_id          = get_field( 'vimeo_video_id' );
	$vimeo_video_name        = get_field( 'vimeo_video_name' );
	$resource_thumbnail      = get_field( 'resource_thumbnails' );
	$gated_asset_button_text = get_field( 'gated_asset_button_text' );
	$ungated_form_heading    = get_field( 'ungated_form_heading' );
	$ungated_form_message    = get_field( 'ungated_form_message' );
	$share_this_post         = get_field( 'share_this_post' );
	$active_campaign_form_id           = get_field( 'active_campaign_form_id' );
	$active_campaign_form_class        = "_form_" . $active_campaign_form_id;

	// strip out all whitespace
	$resource_type_val = $resource_type;
	$resource_type_val = preg_replace( '/\s*/', '', $resource_type_val );

	// convert the string to all lowercase
	$resource_type_cookie_name = strtolower( $resource_type_val );


	$gated_asset_file_name = "";
	if ($resource_type === "Webinar"){
		$gated_asset_file_name = "Vimeo: " . $vimeo_video_name;
	} else {
		$gated_asset_file_name = $resource_file['filename'];
	}
?>