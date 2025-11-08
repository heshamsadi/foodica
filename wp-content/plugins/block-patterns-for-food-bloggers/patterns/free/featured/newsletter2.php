<?php
/**
 * Default content width (Dark version)
 */

return array(
    'title'      => esc_html__( 'Newsletter Form', 'block-patterns-for-food-bloggers' ),
    'categories' => array( 'wpz-featured' ),
    'content'    => '<!-- wp:group {"align":"full","style":{"color":{"background":"#eff4f7"}},"className":"wpz_pattern_18"} -->
<div class="wp-block-group alignfull wpz_pattern_18 has-background" style="background-color:#eff4f7"><!-- wp:columns {"verticalAlignment":"center"} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"24px"}}} -->
<h2 style="font-size:24px;font-style:normal;font-weight:600;text-transform:uppercase">Never miss a recipe!</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#848282"}}} -->
<p class="has-text-color" style="color:#848282">Sign up to our newsletter to receive recipes every week.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:html -->
<form action="/action_page.php">
    <input type="text" placeholder="Name" name="name" required>
    <input type="text" placeholder="Email address" name="mail" required>
    <input type="submit" value="Subscribe">
</form>
<!-- /wp:html --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
);
