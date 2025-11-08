<?php
$url = WPZOOM_FB_PATTERNS_URL . 'patterns/images/';

return array(
    'title'      => esc_html__( 'Newsletter Form', 'block-patterns-for-food-bloggers' ),
    'categories' => array( 'wpz-featured' ),
    'content'    => '<!-- wp:group {"align":"full","style":{"color":{"background":"#eff4f7"}},"className":"wpz_pattern_19"} -->
<div class="wp-block-group alignfull wpz_pattern_19 has-background" style="background-color:#eff4f7"><!-- wp:columns {"verticalAlignment":"center"} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"45%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%"><!-- wp:image {"id":6845,"sizeSlug":"full","linkDestination":"media","className":"is-style-default"} -->
<figure class="wp-block-image size-full is-style-default"><a href="#"><img src="' . $url . 'pexels_6MT4_Ut8a3Y.png" alt="" class="wp-image-6845"/></a></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"3%"} -->
<div class="wp-block-column" style="flex-basis:3%"></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"52%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:52%"><!-- wp:heading {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"24px"}}} -->
<h2 style="font-size:24px;font-style:normal;font-weight:600;text-transform:uppercase">Never miss a recipe!</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#848282"}}} -->
<p class="has-text-color" style="color:#848282">Sign up to our newsletter to receive recipes every week.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<form action="/action_page.php">
    <input type="text" placeholder="Name" name="name" required=""><br>
    <input type="text" placeholder="Email address" name="mail" required=""><br>
    <input type="submit" value="Subscribe">
</form>
<!-- /wp:html --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
);
