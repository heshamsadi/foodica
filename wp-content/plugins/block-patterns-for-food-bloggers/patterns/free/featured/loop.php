<?php
/**
 * Default content width (Dark version)
 */

return array(
    'title'      => esc_html__( 'Posts Grid', 'block-patterns-for-food-bloggers' ),
    'categories' => array( 'wpz-featured' ),
    'content'    => '<!-- wp:group {"align":"full","style":{"color":{"background":"#fafafa"}},"className":"wpz_pattern_14"} -->
<div class="wp-block-group alignfull wpz_pattern_14 has-background" style="background-color:#fafafa"><!-- wp:heading -->
<h2>Ready in 15 minutes</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Donec sed odio dui. Donec id elit non mi porta gravida at eget metus.</p>
<!-- /wp:paragraph -->

<!-- wp:query {"queryId":14,"query":{"perPage":"3","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":false},"displayLayout":{"type":"flex","columns":3}} -->
<div class="wp-block-query"><!-- wp:post-template -->
<!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"}}},"layout":{"inherit":false}} -->
<div class="wp-block-group" style="padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:post-featured-image {"width":"370px","height":"250px"} /-->

<!-- wp:post-terms {"term":"category"} /-->

<!-- wp:post-title {"level":3,"isLink":true,"style":{"typography":{"fontStyle":"normal","fontWeight":"400"}},"fontSize":"medium"} /-->

<!-- wp:post-date {"style":{"color":{"text":"#8b9099"}}} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->',
);