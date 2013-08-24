jQuery(function($){

	// Header and footer height
	set_header_footer_height();
	var resizeTimer;
	$(window).on('resize', function(){
		clearTimeout(resizeTimer);
    resizeTimer = setTimeout(set_header_footer_height, 100);
	});

});

// Header and footer height
function set_header_footer_height(){
	console.log( 'resize' );
	var windowHeight = jQuery(window).height();

	jQuery('.site-header').css('min-height', ( windowHeight * 0.8 ) );
	jQuery('.site-footer').css('min-height', windowHeight );
}