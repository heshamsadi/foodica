<?php
$url = WPZOOM_FB_PATTERNS_URL . 'patterns/images/';

return array(
    'title'      => esc_html__( 'Instagram CTA', 'block-patterns-for-food-bloggers' ),
    'categories' => array( 'wpz-featured' ),
    'content'    => '<!-- wp:group {"style":{"color":{"background":"#fafafa"}},"className":"wpz_pattern_6"} -->
<div class="wp-block-group wpz_pattern_6 has-background" style="background-color:#fafafa"><!-- wp:spacer {"height":"50px"} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:columns {"verticalAlignment":"top"} -->
<div class="wp-block-columns are-vertically-aligned-top"><!-- wp:column {"verticalAlignment":"top","width":"100%"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:100%"><!-- wp:group -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","style":{"color":{"text":"#846c62"}},"fontSize":"medium"} -->
<h2 class="has-text-align-center has-text-color has-medium-font-size" style="color:#846c62">Follow me on Instagram</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:image {"align":"center","id":6762,"width":151,"height":151,"sizeSlug":"full","linkDestination":"media"} -->
<figure class="wp-block-image aligncenter size-full is-resized"><img src="' . $url . 'author.png" alt="" class="wp-image-6762" width="151" height="151"/><figcaption>@instagram</figcaption></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">This is some dummy copy. You’re not really supposed to read this dummy copy, it is just a placeholder for people who need some type to visualize what the actual copy might look like if it were real content.<br></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"textColor":"white","align":"center","style":{"border":{"radius":"4px"},"typography":{"fontSize":"14px"},"color":{"background":"#846c62"}}} -->
<div class="wp-block-button aligncenter has-custom-font-size" style="font-size:14px"><a class="wp-block-button__link has-white-color has-text-color has-background" style="border-radius:4px;background-color:#846c62"><strong>Follow Me on Instagram</strong></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:spacer {"height":"79px"} -->
<div style="height:79px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:image {"align":"center","id":6768,"width":32,"height":32,"sizeSlug":"full","linkDestination":"media"} -->
<figure class="wp-block-image aligncenter size-full is-resized"><img src="' . $url . 'instagram.png" alt="" class="wp-image-6768" width="32" height="32"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top","width":"100%"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:100%"><!-- wp:group -->
<div class="wp-block-group"><!-- wp:gallery {"columns":2,"linkTo":"none"} -->
<figure class="wp-block-gallery has-nested-images columns-2 is-cropped"><!-- wp:image {"id":6348,"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="' . $url . 'pexels-andrea-piacquadio-3771106.jpg" alt="" class="wp-image-6348"/></figure>
<!-- /wp:image -->

<!-- wp:image {"id":5808,"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="' . $url . 'small-1.jpg" alt="" class="wp-image-5808"/></figure>
<!-- /wp:image -->

<!-- wp:image {"id":5807,"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="' . $url . 'small-2.jpg" alt="" class="wp-image-5807"/></figure>
<!-- /wp:image -->

<!-- wp:image {"id":5805,"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="' . $url . 'small-3.jpg" alt="" class="wp-image-5805"/></figure>
<!-- /wp:image --></figure>
<!-- /wp:gallery --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
);
