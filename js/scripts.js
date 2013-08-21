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
	var headerImgHeight = jQuery('.header-img').height();
	var windowHeight = jQuery(window).height();

	jQuery('.site-header').css('min-height', Math.min( windowHeight, headerImgHeight ) );
	jQuery('.site-footer').css('min-height', windowHeight );
}