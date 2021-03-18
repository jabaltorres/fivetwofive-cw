
            <?php // echoHello(); ?>

            <div class="lp-footer p-y-md">
                <div class="container">
                    <div class="container_inner text-center">
                        <ul>
                            <li>
                                <a href="/privacy-policy/">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="/contact/">Contact Us</a>
                            </li>
                            <li>
                                <a href="/license/">Terms & Conditions</a>
                            </li>
                        </ul>
                        <span>Copyright &copy; <?php echo date("Y"); ?> FiveTwoFive Creative. All Rights Reserved.</span>
                    </div>
                </div>
            </div>
            <?php wp_footer(); ?>
		</div><!-- end .wrapper_inner -->
	</div><!-- end .wrapper -->

    <script type="text/javascript">
        jQuery(document).ready(function($) {

            $(".various").fancybox({

                afterShow: function(){
                    if( ($( window ).width()) > 800 ){  $('#main video').css('display','none'); }
                },
                afterClose: function(){
                    if( ($( window ).width()) > 800 ){ $('#main video').css('display','block'); }
                },
                helpers: {
                    overlay: {
                        locked: false
                    }
                }
            });
        });
    </script>

</body>
</html>