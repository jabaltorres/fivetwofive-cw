<?php
/*
Template Name: Gated Template
*/
?>

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
            case 'LI':
                $srcHiddenVal = "LinkedIn";
                $unG8dStep1   = true;
                break;
            case 'RDT':
                $srcHiddenVal = "Reddit";
                $unG8dStep1   = true;
                break;
            case 'STKOVRFLO':
                $srcHiddenVal = "StackOverFlow";
                $unG8dStep1   = true;
                break;
            case 'GGL':
                $srcHiddenVal = "Google";
                $unG8dStep1   = true;
                break;
            case 'TWTR':
                $srcHiddenVal = "Twitter";
                $unG8dStep1   = true;
                break;
            case 'ftf':
                $srcHiddenVal = "ftf Form Tester";
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
//        $ftfUtmSource = $_GET['utm_source'];
//    }
//    if ( isset( $_GET['utm_campaign'] ) ) {
//        $ftfUtmCampaign = $_GET['utm_campaign'];
//    }
//    if ( isset( $_GET['utm_medium'] ) ) {
//        $ftfUtmMedium = $_GET['utm_medium'];
//    }

?>

<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
            // Start the loop.
            while ( have_posts() ) : the_post();
                // Include the page content template.
                get_template_part( '/includes/gated_page' );

            // End of the loop.
            endwhile;
        ?>
    </main><!-- .site-main -->

    <div class="sidebar-gated">
        <?php
            // Pantheon requires this prefixed naming convention (STYXKEY) for setting cookies
            $ftf_cookie_name = "STYXKEY-ftf";

            $gated_asset_file        = get_field( 'gated_asset_file' );
            $gated_asset_type        = get_field( 'gated_asset_type' );
            $gated_asset_thumb_img   = get_field( 'gated_asset_thumb_img' );
            $gated_asset_button_text = get_field( 'gated_asset_button_text' );
            $ungated_form_heading    = get_field( 'ungated_form_heading' );
            $ungated_form_message    = get_field( 'ungated_form_message' );
            $gated_form_id           = get_field( 'gated_form_id' );
            $gated_form_class        = "_form_" . $gated_form_id;

            if ( isset( $_COOKIE[ $ftf_cookie_name ] ) ) {
                $ftfCookieSet = true;
            } else {
                $ftfCookieSet = false;
            }

            // strip out all whitespace
            $gated_asset_type_val = $gated_asset_type;
            $gated_asset_type_val = preg_replace( '/\s*/', '', $gated_asset_type_val );

            // convert the string to all lowercase
            $gated_asset_type_cookie_name = strtolower( $gated_asset_type_val );
        ?>

        <?php if ( $ftfCookieSet || $hardUngate ): ?>

            <!-- Ungated - Hide the form -->
            <h3 class="ungated-header"><?php echo $ungated_form_heading; ?></h3>
            <div class="ungated-message"><?php echo $ungated_form_message; ?></div>
            <a href="<?php echo $gated_asset_file['url']; ?>" class="button" target="_blank"><?php echo $gated_asset_button_text; ?></a>

        <?php else: ?>

            <!-- Gated - Show the form -->
            <div class="ac-form-container">

                <?php /* Start -  modification of Active Campaign's Simple Embed  */?>
                <div class="<?php echo $gated_form_class; ?>"></div>
                <script src="https://jabaltorres.activehosted.com/f/embed.php?id=<?php echo $gated_form_id; ?>" type="text/javascript" charset="utf-8"></script>
	            <?php /* End -  modification of Active Campaign's Simple Embed  */?>

                <script>
                    function ftfSetCookie(name, value, days) {
                        var expires = "";
                        if (days) {
                            var date = new Date();
                            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                            expires = "; expires=" + date.toUTCString();
                        }
                        document.cookie = name + "=" + (value || "") + expires + "; path=/";
                    }

                    function ftfGetCookie(name) {
                        var nameEQ = name + "=";
                        var ca = document.cookie.split(';');
                        for (var i = 0; i < ca.length; i++) {
                            var c = ca[i];
                            while (c.charAt(0) === ' ') {
                                c = c.substring(1, c.length);
                            }
                            if (c.indexOf(nameEQ) === 0) {
                                return c.substring(nameEQ.length, c.length);
                            }
                        }
                        return null;
                    }

                    function ftfEraseCookie(name) {
                        document.cookie = name + '=; Max-Age=-99999999;';
                    }

                    // https://stackoverflow.com/questions/486896/adding-a-parameter-to-the-url-with-javascript
                    function ftfInsertParam(key, value) {
                        key = encodeURI(key);
                        value = encodeURI(value);

                        var kvp = document.location.search.substr(1).split('&');

                        var i = kvp.length;
                        var x;
                        while (i--) {
                            x = kvp[i].split('=');

                            if (x[0] === key) {
                                x[1] = value;
                                kvp[i] = x.join('=');
                                break;
                            }
                        }

                        if (i < 0) {
                            kvp[kvp.length] = [key, value].join('=');
                        }

                        // this will reload the page, it's likely better to store this until finished
                        document.location.search = kvp.join('&');
                    }

                    // Get Query Params
                    // https://github.com/westonruter/pantheon-documentation/blob/master/source/docs/articles/architecture/edge/pantheon_stripped-get-parameter-values.md
                    function getQueryParams(qs) {
                        qs = qs.split("+").join(" ");
                        var params = {}, tokens, re = /[?&]?([^=]+)=([^&]*)/g;

                        while (tokens = re.exec(qs)) {
                            params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
                        }

                        return params;
                    }

                    // check if hidded field exists
                    document.addEventListener("DOMContentLoaded", function () {
                        var sourceHiddenField = document.querySelector("[data-name='source_hidden']");
                        if (sourceHiddenField !== null) {
                            sourceHiddenField.value = "<?php echo $srcHiddenVal; ?>";
                        }

                        var lastGatedFileField = document.querySelector("[data-name='last_gated_file']");
                        if (lastGatedFileField !== null) {
                            lastGatedFileField.value = "<?php echo $gated_asset_file['filename']; ?>";
                        }

                        var lastGatedFileTypeField = document.querySelector("[data-name='last_gate_file_type_hidden']");
                        if (lastGatedFileTypeField !== null) {
                            lastGatedFileTypeField.value = "<?php echo $gated_asset_type; ?>";
                        }

                        var checkboxField = document.querySelector("input[type=checkbox]");
                        if ((checkboxField !== null) && (checkboxField.getAttribute('data-name') === "subscribe_to_newsletter")) {
                            checkboxField.checked = true;
                        }

                        var ftfUtmSourceField = document.querySelector("[data-name='utm_source_hidden']");
                        var ftfUtmCampaignField = document.querySelector("[data-name='utm_campaign_hidden']");
                        var ftfUtmMediumField = document.querySelector("[data-name='utm_medium_hidden']");

                        // Check keys for UTM parameters
                        var query_params = getQueryParams(document.location.search);
                        // console.log(query_params);
                        for (let [key, value] of Object.entries(query_params)) {
                            // console.log(`${key}: ${value}`);
                            if ( (key === "utm_source") && (ftfUtmSourceField !== null) ){
                                ftfUtmSourceField.value = value;
                            }
                            if ( (key === "utm_campaign") && (ftfUtmCampaignField !== null) ){
                                ftfUtmCampaignField.value = value;
                            }
                            if ( (key === "utm_medium") && (ftfUtmMediumField !== null) ){
                                ftfUtmMediumField.value = value;
                            }
                        }
                    });

                    // Run functions on form submit
                    document.querySelector(".<?php echo $gated_form_class; ?>").addEventListener("submit", function (e) {
                        ftfSetCookie('STYXKEY-ftf', '<?php echo $gated_asset_type_cookie_name;?>', 7);

                        // friendly message
                        console.log("Thanks for submitting the form");

                        // scroll to top of page
                        window.scrollTo(0, 0);

                        // this will reload the page,
                        ftfInsertParam("actn", "sbmtd");

                        // check if newsletter subscription checkbox is checked
                        if (document.querySelector("input[type=checkbox][data-name='subscribe_to_newsletter']").checked) {
                            // alert("checked") ;
                            ftfSetCookie('STYXKEY-ftf-subscribed', 'newsletter', 7);
                        }
                    });
                </script>
            </div><!-- end .ac-form-container -->

        <?php endif; ?>

    </div>

    <div style="clear: both;"></div>
</div><!-- .content-area -->

<?php  include_once get_stylesheet_directory() . '/jt_templates/blog/ftf-cta.php'; ?>

<?php get_footer(); ?>