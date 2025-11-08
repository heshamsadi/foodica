<?php
$url = WPZOOM_FB_PATTERNS_URL . 'patterns/images/';

return array(
    'title'      => esc_html__( 'Book', 'block-patterns-for-food-bloggers' ),
    'categories' => array( 'wpz-featured' ),
    'content'    => '<!-- wp:group {"backgroundColor":"black","className":"wpz_pattern_9"} -->
<div class="wp-block-group wpz_pattern_9 has-black-background-color has-background"><!-- wp:columns {"verticalAlignment":"center"} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"30%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:30%"><!-- wp:image {"align":"center","id":6802,"sizeSlug":"full","linkDestination":"media"} -->
<figure class="wp-block-image aligncenter size-full"><a href="#"><img src="' . $url . 'book.png" alt="" class="wp-image-6802"/></a></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"67%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:67%"><!-- wp:heading {"textColor":"white","fontSize":"medium"} -->
<h2 class="has-white-color has-text-color has-medium-font-size">Check out my latest book</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#cdcdcd"}}} -->
<p class="has-text-color" style="color:#cdcdcd">This is some dummy copy. You’re not really supposed to read this dummy copy, it is just a placeholder for people who need some type.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"white","style":{"border":{"radius":"0px"},"color":{"text":"#222222"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-white-background-color has-text-color has-background" style="border-radius:0px;color:#222222">Buy now</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
);
