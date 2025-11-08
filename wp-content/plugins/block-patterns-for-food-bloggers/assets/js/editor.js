// wrapped into IIFE - to leave global space clean.
( function( window, wp ){

	//console.log( wp.hooks );
    // just to keep it cleaner - we refer to our link by id for speed of lookup on DOM.

    // check if gutenberg's editor root element is present.
    var editorEl = document.getElementById( 'editor' );

    if( !editorEl ){ // do nothing if there's no gutenberg root element on page.
        return;
    }

	var unsubscribe = wp.data.subscribe( function () {

        setTimeout( function () {

			jQuery('.wpz_pattern_16 .wp-block-query li .wp-block-group__inner-container, .wpz_pattern_17 .wp-block-query li .wp-block-group__inner-container').each(function(){
				if( !jQuery(this).children().hasClass('wpz-posts-inner-info') ) {
					jQuery(this).children().not(':last').wrapAll("<div class='wpz-posts-inner-info'></div>");
				}
	 
			 });
	 
		}, 1 )
    });
})( window, wp );