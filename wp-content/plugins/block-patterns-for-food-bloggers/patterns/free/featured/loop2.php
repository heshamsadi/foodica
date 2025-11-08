<?php
/**
 * Default content width (Dark version)
 */

return array(
    'title'      => esc_html__( 'Posts Grid (2 Columns)', 'block-patterns-for-food-bloggers' ),
    'categories' => array( 'wpz-featured' ),
    'content'    => '<!-- wp:group {"align":"full","style":{"color":{}},"className":"wpz_pattern_15"} -->
<div class="wp-block-group alignfull wpz_pattern_15"><!-- wp:heading {"style":{"typography":{"fontSize":"24px"}}} -->
<h2 style="font-size:24px">Latest recipes</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p class="wpz-section-desc">Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Donec sed odio dui. Donec id elit non mi porta gravida at eget metus.</p>
<!-- /wp:paragraph -->

<!-- wp:query {"queryId":14,"query":{"perPage":2,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":false},"displayLayout":{"type":"flex","columns":2}} -->
<div class="wp-block-query"><!-- wp:post-template -->
<!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:post-featured-image {"width":"570px","height":"300px"} /-->

<!-- wp:post-terms {"term":"category"} /-->

<!-- wp:post-title {"level":3,"isLink":true,"style":{"typography":{"fontStyle":"normal","fontWeight":"400","fontSize":"24px"}}} /-->

<!-- wp:post-excerpt {"moreText":"Continue Reading →"} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->',
);