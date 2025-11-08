<?php
$url = WPZOOM_FB_PATTERNS_URL . 'patterns/images/';

return array(
    'title'      => esc_html__( 'Newsletter Form', 'block-patterns-for-food-bloggers' ),
    'categories' => array( 'wpz-featured' ),
    'content'    => '<!-- wp:group {"align":"full","style":{"color":{"gradient":"linear-gradient(180deg,rgba(255,234,204,0.35) 4%,rgb(250,208,138) 100%)"}},"className":"wpz_patterns_7"} -->
<div class="wp-block-group alignfull wpz_patterns_7 has-background" style="background:linear-gradient(180deg,rgba(255,234,204,0.35) 4%,rgb(250,208,138) 100%)"><!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:heading {"level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}}} -->
<h1 style="font-style:normal;font-weight:500">I’m Mark and I like to share here my culinary journey</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>This is some dummy copy. You’re not really supposed to read this dummy copy, it is just a placeholder for people who need some type to visualize what the actual copy might look like if it were real content.</p>
<!-- /wp:paragraph -->

<!-- wp:separator {"style":{"color":{"background":"#e2c670"}},"className":"is-style-wide"} -->
<hr class="wp-block-separator has-text-color has-alpha-channel-opacity has-background is-style-wide" style="background-color:#e2c670;color:#e2c670"/>
<!-- /wp:separator -->

<!-- wp:spacer {"height":"47px"} -->
<div style="height:47px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}}} -->
<h3 style="font-style:normal;font-weight:500">Sign up to receive new recipes each week</h3>
<!-- /wp:heading -->

<!-- wp:html -->
<form action="/action_page.php">
    <input type="text" placeholder="Name" name="name" required="">
    <input type="text" placeholder="Email address" name="mail" required="">
    <input type="submit" value="Subscribe">
</form>
<!-- /wp:html --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"10%"} -->
<div class="wp-block-column" style="flex-basis:10%"></div>
<!-- /wp:column -->

<!-- wp:column {"width":"40%"} -->
<div class="wp-block-column" style="flex-basis:40%"><!-- wp:spacer {"height":"60px"} -->
<div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:image {"align":"center","id":6730,"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":{"topLeft":"50em","topRight":"50em","bottomLeft":null,"bottomRight":null}}}} -->
<figure class="wp-block-image aligncenter size-large" style="border-top-left-radius:50em;border-top-right-radius:50em"><img src="' . $url . 'pexels-cottonbro-4253312.jpg" alt="" class="wp-image-6730"/></figure>
<!-- /wp:image -->

<!-- wp:spacer {"height":"60px"} -->
<div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
);
