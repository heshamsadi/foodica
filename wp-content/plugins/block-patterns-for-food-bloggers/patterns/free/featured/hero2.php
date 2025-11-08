<?php

$url = WPZOOM_FB_PATTERNS_URL . 'patterns/images/';

return array(
    'title'      => esc_html__( 'Hero #2', 'block-patterns-for-food-bloggers' ),
    'categories' => array( 'wpz-featured' ),
    'content'    => '<!-- wp:group {"align":"full","style":{"color":{"background":"#fafafa"}},"className":"wpz_pattern_5"} -->
<div class="wp-block-group alignfull wpz_pattern_5 has-background" style="background-color:#fafafa"><!-- wp:spacer {"height":"50px"} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:columns {"verticalAlignment":"center"} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"100%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:100%"><!-- wp:group -->
<div class="wp-block-group"><!-- wp:paragraph -->
<p>HI THERE!</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"fontSize":"medium"} -->
<h2 class="has-medium-font-size">I’m Jessica. Nice of you to visit my blog.</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:paragraph -->
<p>This is some dummy copy. You’re not really supposed to read this dummy copy, it is just a placeholder for people who need some type to visualize what the actual copy might look like if it were real content.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"black","textColor":"white","style":{"border":{"radius":"6px"},"typography":{"fontSize":"14px"}},"className":"is-style-fill"} -->
<div class="wp-block-button has-custom-font-size is-style-fill" style="font-size:14px"><a class="wp-block-button__link has-white-color has-black-background-color has-text-color has-background" style="border-radius:6px"><strong>Learn more about me</strong></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"100%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:100%"><!-- wp:group -->
<div class="wp-block-group"><!-- wp:image {"align":"right","id":6348,"sizeSlug":"medium","linkDestination":"media","className":"is-style-rounded"} -->
<figure class="wp-block-image alignright size-medium is-style-rounded"><a href="#"><img src="' . $url . 'pexels-andrea-piacquadio-3771106.jpg" alt="" class="wp-image-6348"/></a></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"fontSize":"medium"} -->
<h2 class="has-medium-font-size">I was featured in</h2>
<!-- /wp:heading --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"align":"left","id":6561,"sizeSlug":"full","linkDestination":"media"} -->
<figure class="wp-block-image alignleft size-full"><a href="#"><img src="' . $url . 'DAILY-MAGAZINE.png" alt="" class="wp-image-6561"/></a></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"align":"left","id":6563,"sizeSlug":"full","linkDestination":"media"} -->
<figure class="wp-block-image alignleft size-full"><a href="#"><img src="' . $url . 'FOOD-TIMES.png" alt="" class="wp-image-6563"/></a></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"align":"center","id":6564,"sizeSlug":"full","linkDestination":"media"} -->
<figure class="wp-block-image aligncenter size-full"><a href="#"><img src="' . $url . 'MORNING-BOSTON.png" alt="" class="wp-image-6564"/></a></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"align":"left","id":6566,"sizeSlug":"full","linkDestination":"media"} -->
<figure class="wp-block-image alignleft size-full"><a href="#"><img src="' . $url . 'RECIPE-101.png" alt="" class="wp-image-6566"/></a></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"align":"left","id":6572,"sizeSlug":"full","linkDestination":"media"} -->
<figure class="wp-block-image alignleft size-full"><a href="#"><img src="' . $url . 'TRM-NETWORK.png" alt="" class="wp-image-6572"/></a></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
);
