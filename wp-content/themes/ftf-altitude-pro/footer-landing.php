
        <div class="lp-footer py-3">
            <div class="container">
                <div class="row text-center">
                    <div class="col-12">
                        <?php wp_nav_menu( array('menu' => 'Menu LP Footer','menu_class' => 'p-0', 'menu_id' => 'menu-lp-footer' ));?>
                        <span>Copyright &copy; <?php echo date("Y"); ?> FiveTwoFive Creative. All Rights Reserved.</span>
                    </div>
                </div>
            </div>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>