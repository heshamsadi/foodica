<?php
$url = WPZOOM_FB_PATTERNS_URL . 'patterns/images/';

return array(
    'title'      => esc_html__( 'Featured Categories', 'block-patterns-for-food-bloggers' ),
    'categories' => array( 'wpz-featured' ),
    'content'    => '<!-- wp:group {"align":"full","style":{"color":{"background":"#fafafa"}},"className":"wpz_pattern_2"} -->
<div class="wp-block-group alignfull wpz_pattern_2 has-background" style="background-color:#fafafa"><!-- wp:spacer {"height":"50px","className":"eplus-wrapper"} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer eplus-wrapper"></div>
<!-- /wp:spacer -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:heading -->
<h2>Featured Categories</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>This is some dummy copy. You’re not really supposed to read this dummy copy, it is just a placeholder for people who need some type to visualize what the actual copy might look like if it were real content.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:cover {"url":"' . $url . 'foodiesfeed.com_fancy-dinner-with-seafood-pasta-and-crayfish.jpg","id":229,"dimRatio":50,"minHeight":100,"minHeightUnit":"px","contentPosition":"center center","className":"is-style-editorskit-rounded eplus-wrapper"} -->
<div class="wp-block-cover is-style-editorskit-rounded eplus-wrapper" style="min-height:100px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim"></span><img class="wp-block-cover__image-background wp-image-229" alt="" src="' . $url . 'foodiesfeed.com_fancy-dinner-with-seafood-pasta-and-crayfish.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":3,"textColor":"white","className":"eplus-wrapper","fontSize":"medium"} -->
<h3 class="has-text-align-center eplus-wrapper has-white-color has-text-color has-medium-font-size"><a href="#"><strong>Pasta</strong></a></h3>
<!-- /wp:heading --></div></div>
<!-- /wp:cover -->

<!-- wp:spacer {"height":"25px"} -->
<div style="height:25px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:cover {"url":"' . $url . 'foodiesfeed.com_cheese-appetizer.jpg","id":209,"dimRatio":50,"minHeight":100,"minHeightUnit":"px","isDark":false,"className":"is-style-editorskit-rounded eplus-wrapper"} -->
<div class="wp-block-cover is-light is-style-editorskit-rounded eplus-wrapper" style="min-height:100px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim"></span><img class="wp-block-cover__image-background wp-image-209" alt="" src="' . $url . 'foodiesfeed.com_cheese-appetizer.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":3,"textColor":"white","className":"eplus-wrapper","fontSize":"medium"} -->
<h3 class="has-text-align-center eplus-wrapper has-white-color has-text-color has-medium-font-size"><strong><a href="#">Appetizers</a></strong></h3>
<!-- /wp:heading --></div></div>
<!-- /wp:cover -->

<!-- wp:spacer {"height":"25px"} -->
<div style="height:25px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:cover {"url":"' . $url . 'foodiesfeed.com_lemon-basil-sponge-cake.jpg","id":5805,"dimRatio":50,"minHeight":100,"minHeightUnit":"px","isDark":false,"className":"is-style-editorskit-rounded eplus-wrapper"} -->
<div class="wp-block-cover is-light is-style-editorskit-rounded eplus-wrapper" style="min-height:100px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim"></span><img class="wp-block-cover__image-background wp-image-5805" alt="" src="' . $url . 'foodiesfeed.com_lemon-basil-sponge-cake.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":3,"textColor":"white","className":"eplus-wrapper","fontSize":"medium"} -->
<h3 class="has-text-align-center eplus-wrapper has-white-color has-text-color has-medium-font-size"><a href="#"><strong>Desserts</strong></a></h3>
<!-- /wp:heading --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:spacer {"height":"50px","className":"eplus-wrapper"} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer eplus-wrapper"></div>
<!-- /wp:spacer --></div>
<!-- /wp:group -->',
);
