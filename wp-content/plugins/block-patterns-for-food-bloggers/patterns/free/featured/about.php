<?php

$url = WPZOOM_FB_PATTERNS_URL . 'patterns/images/';

return array(
    'title'      => esc_html__( 'About Me', 'block-patterns-for-food-bloggers' ),
    'categories' => array( 'wpz-featured' ),
    'content'    => '<!-- wp:media-text {"align":"","mediaId":6348,"mediaLink":"#","mediaType":"image","mediaWidth":47,"className":"wpz_pattern_4"} -->
<div class="wp-block-media-text is-stacked-on-mobile wpz_pattern_4" style="grid-template-columns:47% auto"><figure class="wp-block-media-text__media"><img src="' . $url . 'pexels-andrea-piacquadio-3771106.jpg" alt="" class="wp-image-6348 size-full"/></figure><div class="wp-block-media-text__content"><!-- wp:group {"style":{"color":{"background":"#fafafa"}},"className":"eplus-wrapper"} -->
<div class="wp-block-group eplus-wrapper has-background" style="background-color:#fafafa"><!-- wp:spacer {"height":"50px"} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:paragraph {"className":"eplus-wrapper"} -->
<p class="eplus-wrapper">HI THERE!</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"fontSize":"medium"} -->
<h2 class="has-medium-font-size">I’m Jessica. Nice of you to visit my blog.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"eplus-wrapper"} -->
<p class="eplus-wrapper">This is some dummy copy. You’re not really supposed to read this dummy copy, it is just a placeholder for people who need some type to visualize what the actual copy might look like if it were real content.</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {"height":"50px"} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer --></div>
<!-- /wp:group --></div></div>
<!-- /wp:media-text -->',
);