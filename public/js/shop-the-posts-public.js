(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(function() {

		$('.share-the-posts-link').each(function(){
			var $stp_link = $(this),
				$post = $(this).closest( 'article.post' ),
				$stp_content = $post.find( '.share-the-posts-content' );

			$stp_link.on( 'mouseenter', function(){
				console.log('enter');
				$stp_content.addClass('visible');
			});

			$post.on( 'mouseleave', function(){
				console.log('out');
				$stp_content.removeClass('visible');
			});

		});


		$(window).scroll(function() {
		    checkOffset();
		});


		function checkOffset() {
		    if($('.share-the-posts-single-sticky').offset().top + $('.share-the-posts-single-sticky').height() 
		                                           >= $('footer#colophon').offset().top - 50)
		        $('.share-the-posts-single-sticky').css('position', 'absolute');
		    if($(document).scrollTop() + window.innerHeight < $('footer#colophon').offset().top)
		        $('.share-the-posts-single-sticky').css('position', 'fixed'); // restore when you scroll up
		}
	
	});

})( jQuery );
