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