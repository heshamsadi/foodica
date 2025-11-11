<?php<?php

/**/**

 * Enhanced Recipe Post Template * Single Post Template - Recipe Posts

 * Optimized for AdSense, speed, and engagement * 

 */ * Displays individual blog posts with recipe meta box data

 * Automatically applied to all single posts

get_header(); ?> */



<div id="primary" class="content-area">get_header(); ?>

    <main id="main" class="site-main" role="main">

<div id="primary" class="content-area">

        <?php while ( have_posts() ) : the_post();    <main id="main" class="site-main" role="main">

            // Get recipe meta data

            $meta = array(        <?php

                'prep' => get_post_meta(get_the_ID(), 'recipe_prep_time', true),        while ( have_posts() ) :

                'cook' => get_post_meta(get_the_ID(), 'recipe_cook_time', true),            the_post();

                'total' => get_post_meta(get_the_ID(), 'recipe_total_time', true),            ?>

                'servings' => get_post_meta(get_the_ID(), 'recipe_servings', true),

                'calories' => get_post_meta(get_the_ID(), 'recipe_calories', true),            <article id="post-<?php the_ID(); ?>" <?php post_class('recipe-post'); ?>>

                'intro' => get_post_meta(get_the_ID(), 'recipe_introduction', true),                

                'ingredients' => get_post_meta(get_the_ID(), 'recipe_ingredients', true),                <!-- Recipe Header -->

                'directions' => get_post_meta(get_the_ID(), 'recipe_directions', true),                <header class="entry-header recipe-header">

                'tips' => get_post_meta(get_the_ID(), 'recipe_tips', true),                    <h1 class="entry-title recipe-title"><?php the_title(); ?></h1>

                'difficulty' => get_post_meta(get_the_ID(), 'recipe_difficulty', true),                    

                'cost' => get_post_meta(get_the_ID(), 'recipe_cost', true),                    <div class="entry-meta recipe-meta">

            );                        <?php

        ?>                        // Get custom fields

                        $prep_time = get_post_meta( get_the_ID(), 'recipe_prep_time', true );

        <!-- JUMP TO RECIPE BUTTON -->                        $cook_time = get_post_meta( get_the_ID(), 'recipe_cook_time', true );

        <div class="jump-to-recipe">                        $total_time = get_post_meta( get_the_ID(), 'recipe_total_time', true );

            <a href="#recipe-section" class="btn-jump">Jump to Recipe ⬇</a>                        $servings = get_post_meta( get_the_ID(), 'recipe_servings', true );

        </div>                        $calories = get_post_meta( get_the_ID(), 'recipe_calories', true );

                        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('recipe-post'); ?> itemscope itemtype="https://schema.org/Recipe">                        

                                    <?php if ( $prep_time ) : ?>

            <!-- AD SLOT 1: Below Title -->                            <span class="recipe-time prep-time">

            <div class="ad-container ad-after-title">                                <strong>Prep:</strong> <?php echo esc_html( $prep_time ); ?>

                <?php if ( function_exists('adsense_display_ad') ) adsense_display_ad('after_title'); ?>                            </span>

            </div>                        <?php endif; ?>

                        

            <!-- RECIPE HEADER -->                        <?php if ( $cook_time ) : ?>

            <header class="entry-header recipe-header">                            <span class="recipe-time cook-time">

                <h1 class="entry-title recipe-title" itemprop="name"><?php the_title(); ?></h1>                                <strong>Cook:</strong> <?php echo esc_html( $cook_time ); ?>

                                            </span>

                <!-- DIFFICULTY & COST BADGES -->                        <?php endif; ?>

                <?php if ($meta['difficulty'] || $meta['cost']) : ?>                        

                <div class="recipe-badges">                        <?php if ( $total_time ) : ?>

                    <?php if ($meta['difficulty']) : ?>                            <span class="recipe-time total-time">

                        <span class="badge difficulty-<?php echo esc_attr(strtolower($meta['difficulty'])); ?>">                                <strong>Total:</strong> <?php echo esc_html( $total_time ); ?>

                            <?php echo esc_html($meta['difficulty']); ?>                            </span>

                        </span>                        <?php endif; ?>

                    <?php endif; ?>                        

                    <?php if ($meta['cost']) : ?>                        <?php if ( $servings ) : ?>

                        <span class="badge cost-<?php echo esc_attr(strtolower($meta['cost'])); ?>">                            <span class="recipe-servings">

                            <?php echo esc_html($meta['cost']); ?>                                <strong>Servings:</strong> <?php echo esc_html( $servings ); ?>

                        </span>                            </span>

                    <?php endif; ?>                        <?php endif; ?>

                </div>                        

                <?php endif; ?>                        <?php if ( $calories ) : ?>

                            <span class="recipe-calories">

                <!-- META DATA WITH ICONS -->                                <strong>Calories:</strong> <?php echo esc_html( $calories ); ?>

                <div class="entry-meta recipe-meta">                            </span>

                    <?php if ($meta['prep']) : ?>                        <?php endif; ?>

                        <span class="meta-item">                    </div>

                            <span class="meta-icon">⏱️</span>                    

                            <strong>Prep:</strong> <span itemprop="prepTime"><?php echo esc_html($meta['prep']); ?></span>                    <?php the_category(', '); ?>

                        </span>                    <div class="entry-date"><?php echo get_the_date(); ?></div>

                    <?php endif; ?>                </header>

                    <?php if ($meta['cook']) : ?>

                        <span class="meta-item">                <!-- Featured Image -->

                            <span class="meta-icon">🔥</span>                <?php if ( has_post_thumbnail() ) : ?>

                            <strong>Cook:</strong> <span itemprop="cookTime"><?php echo esc_html($meta['cook']); ?></span>                    <div class="recipe-featured-image">

                        </span>                        <?php the_post_thumbnail( 'large', array( 'class' => 'recipe-main-image' ) ); ?>

                    <?php endif; ?>                    </div>

                    <?php if ($meta['total']) : ?>                <?php endif; ?>

                        <span class="meta-item">

                            <span class="meta-icon">⏲️</span>                <!-- Recipe Introduction -->

                            <strong>Total:</strong> <span itemprop="totalTime"><?php echo esc_html($meta['total']); ?></span>                <div class="recipe-introduction">

                        </span>                    <?php

                    <?php endif; ?>                    $intro = get_post_meta( get_the_ID(), 'recipe_introduction', true );

                    <?php if ($meta['servings']) : ?>                    if ( $intro ) {

                        <span class="meta-item">                        echo wp_kses_post( wpautop( $intro ) );

                            <span class="meta-icon">🍽️</span>                    }

                            <strong>Servings:</strong> <span itemprop="recipeYield"><?php echo esc_html($meta['servings']); ?></span>                    ?>

                        </span>                </div>

                    <?php endif; ?>

                    <?php if ($meta['calories']) : ?>                <!-- Recipe Content -->

                        <span class="meta-item">                <div class="entry-content recipe-content">

                            <span class="meta-icon">🔥</span>                    

                            <strong>Calories:</strong> <?php echo esc_html($meta['calories']); ?>                    <!-- Ingredients -->

                        </span>                    <?php

                    <?php endif; ?>                    $ingredients = get_post_meta( get_the_ID(), 'recipe_ingredients', true );

                </div>                    if ( $ingredients ) :

                    ?>

                <!-- ACTIONS -->                        <div class="recipe-section recipe-ingredients">

                <div class="recipe-actions">                            <h2 class="recipe-section-title">Ingredients</h2>

                    <?php the_category(', '); ?>                            <div class="recipe-ingredients-list">

                    <div class="entry-date"><?php echo get_the_date(); ?></div>                                <?php echo wp_kses_post( wpautop( $ingredients ) ); ?>

                    <button class="btn-print" onclick="window.print()">🖨️ Print</button>                            </div>

                </div>                        </div>

            </header>                    <?php endif; ?>



            <!-- AD SLOT 2: After Intro -->                    <!-- Directions -->

            <div class="ad-container ad-after-intro">                    <?php

                <?php if ( function_exists('adsense_display_ad') ) adsense_display_ad('after_intro'); ?>                    $directions = get_post_meta( get_the_ID(), 'recipe_directions', true );

            </div>                    if ( $directions ) :

                    ?>

            <!-- FEATURED IMAGE WITH LAZY LOAD -->                        <div class="recipe-section recipe-directions">

            <?php if ( has_post_thumbnail() ) : ?>                            <h2 class="recipe-section-title">Directions</h2>

                <div class="recipe-featured-image" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">                            <div class="recipe-directions-list">

                    <?php                                 <?php echo wp_kses_post( wpautop( $directions ) ); ?>

                    $image_id = get_post_thumbnail_id();                            </div>

                    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);                        </div>

                    $image_url = wp_get_attachment_image_src($image_id, 'full');                    <?php endif; ?>

                    if ($image_url) $image_url = $image_url[0];

                    ?>                    <!-- Tips -->

                    <img class="recipe-main-image lazyload"                     <?php

                         src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 800 400'%3E%3C/svg%3E"                    $tips = get_post_meta( get_the_ID(), 'recipe_tips', true );

                         data-src="<?php echo esc_url($image_url); ?>"                    if ( $tips ) :

                         alt="<?php echo esc_attr($image_alt ?: get_the_title()); ?>"                     ?>

                         loading="lazy"                        <div class="recipe-section recipe-tips">

                         itemprop="url">                            <h2 class="recipe-section-title">Tips</h2>

                    <meta itemprop="width" content="800">                            <div class="recipe-tips-list">

                    <meta itemprop="height" content="400">                                <?php echo wp_kses_post( wpautop( $tips ) ); ?>

                </div>                            </div>

            <?php endif; ?>                        </div>

                    <?php endif; ?>

            <!-- INTRODUCTION -->

            <?php if ($meta['intro']) : ?>                    <!-- Additional Content (from main editor) -->

                <div class="recipe-introduction" itemprop="description">                    <?php the_content(); ?>

                    <?php echo wp_kses_post(wpautop($meta['intro'])); ?>

                </div>                </div>

            <?php endif; ?>

                <!-- Recipe Footer -->

            <!-- AD SLOT 3: Before Recipe -->                <footer class="entry-footer recipe-footer">

            <div class="ad-container ad-before-recipe">                    <?php

                <?php if ( function_exists('adsense_display_ad') ) adsense_display_ad('before_recipe'); ?>                    // Tags

            </div>                    the_tags( '<div class="recipe-tags"><strong>Tags:</strong> ', ', ', '</div>' );

                    ?>

            <!-- RECIPE CONTENT START -->                </footer>

            <div id="recipe-section" class="recipe-content-wrapper">

            </article>

                <!-- SERVING ADJUSTER -->

                <?php if ($meta['servings']) : ?>            <?php

                <div class="serving-adjuster">            // Comments

                    <label>Servings: </label>            if ( comments_open() || get_comments_number() ) :

                    <button class="adjuster-btn" onclick="adjustServings(-1)">−</button>                comments_template();

                    <input type="number" id="servings-input" value="<?php echo esc_attr(preg_replace('/[^0-9]/', '', $meta['servings']) ?: '4'); ?>" min="1" max="20" readonly>            endif;

                    <button class="adjuster-btn" onclick="adjustServings(1)">+</button>

                </div>        endwhile;

                <?php endif; ?>        ?>



                <!-- INGREDIENTS -->    </main>

                <?php if ($meta['ingredients']) : ?></div>

                    <div class="recipe-section recipe-ingredients">

                        <h2 class="recipe-section-title">📋 Ingredients</h2><?php

                        <div class="recipe-ingredients-list" id="ingredients-list" itemprop="recipeIngredient">get_sidebar();

                            <?php get_footer();

                            $ingredients_array = explode("\n", $meta['ingredients']);
                            foreach ($ingredients_array as $ingredient) {
                                $ingredient = trim($ingredient);
                                if (!empty($ingredient)) {
                                    // Remove bullet points and list markers
                                    $ingredient = preg_replace('/^[•\-\*]\s*/', '', $ingredient);
                                    echo '<label class="ingredient-item">
                                            <input type="checkbox" class="ingredient-checkbox"> 
                                            <span class="ingredient-text">' . esc_html($ingredient) . '</span>
                                          </label>';
                                }
                            }
                            ?>
                        </div>
                        <button class="btn-clear" onclick="clearCheckedIngredients()">Clear Checked</button>
                    </div>
                <?php endif; ?>

                <!-- AD SLOT 4: Between Ingredients & Directions -->
                <div class="ad-container ad-between-sections">
                    <?php if ( function_exists('adsense_display_ad') ) adsense_display_ad('between_sections'); ?>
                </div>

                <!-- DIRECTIONS -->
                <?php if ($meta['directions']) : ?>
                    <div class="recipe-section recipe-directions">
                        <h2 class="recipe-section-title">👨‍🍳 Directions</h2>
                        <div class="recipe-directions-list" id="directions-list" itemprop="recipeInstructions">
                            <?php 
                            $directions_array = explode("\n", $meta['directions']);
                            $step_num = 1;
                            foreach ($directions_array as $direction) {
                                $direction = trim($direction);
                                if (!empty($direction)) {
                                    // Remove existing numbers
                                    $direction = preg_replace('/^[0-9]+[\.\)]\s*/', '', $direction);
                                    echo '<div class="direction-item" data-step="' . $step_num . '">
                                            <div class="direction-header">
                                                <span class="step-number">' . $step_num . '</span>
                                                <button class="timer-btn" onclick="startTimer(60, this)">⏱️ Timer</button>
                                            </div>
                                            <div class="direction-text">' . esc_html($direction) . '</div>
                                            <div class="timer-display" style="display:none;"></div>
                                          </div>';
                                    $step_num++;
                                }
                            }
                            ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- TIPS -->
                <?php if ($meta['tips']) : ?>
                    <div class="recipe-section recipe-tips">
                        <h2 class="recipe-section-title">💡 Pro Tips</h2>
                        <div class="recipe-tips-list">
                            <?php 
                            $tips_array = explode("\n", $meta['tips']);
                            foreach ($tips_array as $tip) {
                                $tip = trim($tip);
                                if (!empty($tip)) {
                                    $tip = preg_replace('/^[•\-\*]\s*/', '', $tip);
                                    echo '<div class="tip-item">' . esc_html($tip) . '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- NUTRITION INFO -->
                <?php if ($meta['calories']) : ?>
                <div class="recipe-nutrition">
                    <button class="nutrition-toggle" onclick="toggleNutrition()">🔍 View Nutrition Facts</button>
                    <div class="nutrition-panel" style="display:none;" itemprop="nutrition" itemscope itemtype="https://schema.org/NutritionInformation">
                        <p><strong>Calories:</strong> <span itemprop="calories"><?php echo esc_html($meta['calories']); ?></span></p>
                        <p class="disclaimer">*Estimated values. Consult a nutritionist for medical dietary advice.</p>
                    </div>
                </div>
                <?php endif; ?>

                <!-- AD SLOT 5: After Recipe -->
                <div class="ad-container ad-after-recipe">
                    <?php if ( function_exists('adsense_display_ad') ) adsense_display_ad('after_recipe'); ?>
                </div>

                <!-- SOCIAL SHARING -->
                <div class="recipe-sharing">
                    <h3>Share This Recipe</h3>
                    <?php 
                    $share_url = urlencode(get_permalink());
                    $share_title = urlencode(get_the_title());
                    $share_image = has_post_thumbnail() ? urlencode(get_the_post_thumbnail_url(get_the_ID(), 'full')) : '';
                    ?>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>" target="_blank" class="share-btn facebook" rel="noopener">Facebook</a>
                    <a href="https://pinterest.com/pin/create/button/?url=<?php echo $share_url; ?>&media=<?php echo $share_image; ?>&description=<?php echo $share_title; ?>" target="_blank" class="share-btn pinterest" rel="noopener">Pinterest</a>
                    <a href="https://twitter.com/intent/tweet?text=<?php echo $share_title; ?>&url=<?php echo $share_url; ?>" target="_blank" class="share-btn twitter" rel="noopener">Twitter</a>
                </div>

                <!-- Additional Content from Main Editor -->
                <?php the_content(); ?>

            </div><!-- .recipe-content-wrapper -->

            <!-- RECIPE FOOTER -->
            <footer class="entry-footer recipe-footer">
                <?php the_tags( '<div class="recipe-tags"><strong>Tags:</strong> ', ', ', '</div>' ); ?>
            </footer>

        </article>

        <?php
        // Comments
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
        ?>

        <?php endwhile; ?>

    </main>
</div>

<?php
get_sidebar();
get_footer();
