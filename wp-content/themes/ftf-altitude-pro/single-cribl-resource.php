<?php include "includes/resource_gating_logic.php";?>

<?php
/**
 * Template Name: Resource Single
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The Authority
 */


get_header(); ?>

	<div id="primary" class="">
		<main id="main" class="site-main" role="main">
            <?php while ( have_posts() ) : the_post();

                get_template_part( '/includes/single_cribl_resource' );

            endwhile; ?>
		</main><!-- #main -->

		<?php if ($assetUngated): ?>
			<div class="sidebar ungated">
				<!-- Ungated - Hide the form -->
				<?php if ($ungated_form_heading): ?>
					<h3 class="ungated-header m-b-sm"><?php echo $ungated_form_heading; ?></h3>
				<?php endif; ?>

				<?php if ($ungated_form_message): ?>
					<div class="ungated-message m-b-sm"><?php echo $ungated_form_message; ?></div>
				<?php endif; ?>

				<?php if ($resource_file['url'] && $gated_asset_button_text):?>
					<a href="<?php echo $resource_file['url']; ?>" class="button" target="_blank"><?php echo $gated_asset_button_text; ?></a>
				<?php endif; ?>
			</div>
		<?php else: ?>
			<div class="sidebar gated">

				<!-- Gated - Show the form -->
				<div class="ac-form-container">
					<?php /* Start -  modification of Active Campaign's Simple Embed  */?>
					<div class="<?php echo $active_campaign_form_class; ?>"></div>
					<script src="https://cribl.activehosted.com/f/embed.php?id=<?php echo $active_campaign_form_id; ?>" type="text/javascript" charset="utf-8"></script>
					<?php /* End -  modification of Active Campaign's Simple Embed  */?>
				</div><!-- end .ac-form-container -->
			</div>
		<?php endif; ?>

		<div style="clear: both;"></div>

		<script>
            function criblSetCookie(name, value, days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "") + expires + "; path=/";
            }

            function criblGetCookie(name) {
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

            function criblEraseCookie(name) {
                document.cookie = name + '=; Max-Age=-99999999;';
            }

            // https://stackoverflow.com/questions/486896/adding-a-parameter-to-the-url-with-javascript
            function criblInsertParam(key, value) {
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
                    lastGatedFileField.value = "<?php echo $gated_asset_file_name; ?>";
                }

                var lastGatedFileTypeField = document.querySelector("[data-name='last_gate_file_type_hidden']");
                if (lastGatedFileTypeField !== null) {
                    lastGatedFileTypeField.value = "<?php echo $resource_type; ?>";
                }

                var checkboxField = document.querySelector("input[type=checkbox]");
                if ((checkboxField !== null) && (checkboxField.getAttribute('data-name') === "subscribe_to_newsletter")) {
                    checkboxField.checked = true;
                }

                var criblUtmSourceField = document.querySelector("[data-name='utm_source_hidden']");
                var criblUtmCampaignField = document.querySelector("[data-name='utm_campaign_hidden']");
                var criblUtmMediumField = document.querySelector("[data-name='utm_medium_hidden']");

                // Check keys for UTM parameters
                var query_params = getQueryParams(document.location.search);
                // console.log(query_params);
                for (let [key, value] of Object.entries(query_params)) {
                    // console.log(`${key}: ${value}`);
                    if ( (key === "utm_source") && (criblUtmSourceField !== null) ){
                        criblUtmSourceField.value = value;
                    }
                    if ( (key === "utm_campaign") && (criblUtmCampaignField !== null) ){
                        criblUtmCampaignField.value = value;
                    }
                    if ( (key === "utm_medium") && (criblUtmMediumField !== null) ){
                        criblUtmMediumField.value = value;
                    }
                }
            });

            // Run functions on form submit
            document.querySelector(".<?php echo $active_campaign_form_class; ?>").addEventListener("submit", function (e) {
                criblSetCookie('STYXKEY-cribl', '<?php echo $resource_type_cookie_name;?>', 7);

                // friendly message
                console.log("Thanks for submitting the form");

                // scroll to top of page
                window.scrollTo(0, 0);

                // this will reload the page,
                criblInsertParam("actn", "sbmtd");

                // check if newsletter subscription checkbox is checked
                if (document.querySelector("input[type=checkbox][data-name='subscribe_to_newsletter']").checked) {
                    // alert("checked") ;
                    criblSetCookie('STYXKEY-cribl-subscribed', 'newsletter', 7);
                }
            });
		</script>
	</div><!-- #primary -->

<?php // include_once get_stylesheet_directory() . '/rs_templates/blog/cribl-sandbox-cta.php'; ?>
<?php include_once get_stylesheet_directory() . '/includes/lp_three_col_cta_section.php'; ?>

<?php get_footer(); ?>