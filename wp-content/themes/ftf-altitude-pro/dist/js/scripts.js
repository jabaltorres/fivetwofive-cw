( function ( document, $, undefined ) {
	// Element fade in on scroll
    $(document).ready(function() {

        /* JT Modal */
        if ($('.has-modal').length) {
            $('.has-modal img').on('click', function (e) {
                e.preventDefault();
                // var lgImgSrc = $(this).attr('src').indexOf("-sm.") > 0 ? $(this).attr('src').replace("-sm.", ".") : $(this).attr('src');
                var lgImgSrc = $(this).attr('src');
                $('#imagePreview').attr('src', lgImgSrc.replace(/&width=.*/, ""));
                $('#imageModalLabel').html($(this).attr('alt'));
            });

            $('#jtModal').appendTo("body");
        }
    });
})( document, jQuery );
jQuery(function( $ ){

	if( $( document ).scrollTop() > 0 ){
		$( '.site-header' ).addClass( 'dark' );			
	}

	$(".site-container").append('<div class="scroll-to-top"></div>');

	if ($(document).height() > $(window).height()) {
		$('.scroll-to-top').addClass('d-block');
	}

	$(".scroll-to-top").click(function(){
	  var body = $("html, body");
	  body.animate({scrollTop:0}, '500', 'swing');
	});

	// Add opacity class to site header
	$( document ).on('scroll', function(){

		if ( $( document ).scrollTop() > 0 ){
			$( '.site-header' ).addClass( 'dark' );			
			$('.scroll-to-top').addClass('scroll-to-top-show d-block');
			$('.scroll-to-top').removeClass('scroll-to-top-hide');			

		} else {
			$( '.site-header' ).removeClass( 'dark' );
			$('.scroll-to-top').addClass('scroll-to-top-hide');
			$('.scroll-to-top').removeClass('scroll-to-top-show d-block');
		}

	});


	$( '.nav-primary .genesis-nav-menu, .nav-secondary .genesis-nav-menu' ).addClass( 'responsive-menu' ).before('<div class="responsive-menu-icon"></div>');


	$( '.responsive-menu-icon' ).click(function(){
		$(this).next( '.nav-primary .genesis-nav-menu,  .nav-secondary .genesis-nav-menu' ).slideToggle();
	});


	$( window ).resize(function(){
		if ( window.innerWidth > 800 ) {
			$( '.nav-primary .genesis-nav-menu,  .nav-secondary .genesis-nav-menu, nav .sub-menu' ).removeAttr( 'style' );
			$( '.responsive-menu > .menu-item' ).removeClass( 'menu-open' );
		}
	});


	$( '.responsive-menu > .menu-item' ).click(function(event){
		if ( event.target !== this )
            return;

            $(this).find( '.sub-menu:first' ).slideToggle(function() {
                $(this).parent().toggleClass( 'menu-open' );
			});

	});

	$('#menu-primary-nav a').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html, body').animate({
					scrollTop: target.offset().top
				}, 500);
				return false;
			}
		}
	});

});



// Theme Scripts
jQuery(function( $ ){
	if ($('.front-page').length) {
		if (document.location.hash) {
			window.setTimeout(function () {
				document.location.href += '';
			}, 10);
		}

		// Local Scroll Speed
		$.localScroll({
			duration: 750
		});

		// Image Section Height
		var windowHeight = $( window ).height();

		$( '.image-section' ) .css({'height': windowHeight +'px'});

		$( window ).resize(function(){
			var windowHeight = $( window ).height();

			$( '.image-section' ) .css({'height': windowHeight +'px'});
		});
	}
});
