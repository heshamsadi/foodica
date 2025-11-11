# RECIPE POST TEMPLATE - MARKUP & STYLES

This document contains the complete HTML markup structure and CSS styling for the single recipe post template. Use this as a reference to create an enhanced version.

---

## 📋 HTML MARKUP STRUCTURE

### Complete PHP Template (`single.php`)

```php
<?php
/**
 * Single Post Template - Recipe Posts
 * Displays individual blog posts with recipe meta box data
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('recipe-post'); ?>>
                
                <!-- ============================================ -->
                <!-- RECIPE HEADER SECTION -->
                <!-- ============================================ -->
                <header class="entry-header recipe-header">
                    <!-- Recipe Title -->
                    <h1 class="entry-title recipe-title"><?php the_title(); ?></h1>
                    
                    <!-- Recipe Meta: Timing & Nutrition -->
                    <div class="entry-meta recipe-meta">
                        <?php
                        $prep_time = get_post_meta( get_the_ID(), 'recipe_prep_time', true );
                        $cook_time = get_post_meta( get_the_ID(), 'recipe_cook_time', true );
                        $total_time = get_post_meta( get_the_ID(), 'recipe_total_time', true );
                        $servings = get_post_meta( get_the_ID(), 'recipe_servings', true );
                        $calories = get_post_meta( get_the_ID(), 'recipe_calories', true );
                        ?>
                        
                        <?php if ( $prep_time ) : ?>
                            <span class="recipe-time prep-time">
                                <strong>Prep:</strong> <?php echo esc_html( $prep_time ); ?>
                            </span>
                        <?php endif; ?>
                        
                        <?php if ( $cook_time ) : ?>
                            <span class="recipe-time cook-time">
                                <strong>Cook:</strong> <?php echo esc_html( $cook_time ); ?>
                            </span>
                        <?php endif; ?>
                        
                        <?php if ( $total_time ) : ?>
                            <span class="recipe-time total-time">
                                <strong>Total:</strong> <?php echo esc_html( $total_time ); ?>
                            </span>
                        <?php endif; ?>
                        
                        <?php if ( $servings ) : ?>
                            <span class="recipe-servings">
                                <strong>Servings:</strong> <?php echo esc_html( $servings ); ?>
                            </span>
                        <?php endif; ?>
                        
                        <?php if ( $calories ) : ?>
                            <span class="recipe-calories">
                                <strong>Calories:</strong> <?php echo esc_html( $calories ); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Categories & Date -->
                    <?php the_category(', '); ?>
                    <div class="entry-date"><?php echo get_the_date(); ?></div>
                </header>

                <!-- ============================================ -->
                <!-- FEATURED IMAGE -->
                <!-- ============================================ -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="recipe-featured-image">
                        <?php the_post_thumbnail( 'large', array( 'class' => 'recipe-main-image' ) ); ?>
                    </div>
                <?php endif; ?>

                <!-- ============================================ -->
                <!-- RECIPE INTRODUCTION -->
                <!-- ============================================ -->
                <div class="recipe-introduction">
                    <?php
                    $intro = get_post_meta( get_the_ID(), 'recipe_introduction', true );
                    if ( $intro ) {
                        echo wp_kses_post( wpautop( $intro ) );
                    }
                    ?>
                </div>

                <!-- ============================================ -->
                <!-- RECIPE CONTENT SECTIONS -->
                <!-- ============================================ -->
                <div class="entry-content recipe-content">
                    
                    <!-- INGREDIENTS SECTION -->
                    <?php
                    $ingredients = get_post_meta( get_the_ID(), 'recipe_ingredients', true );
                    if ( $ingredients ) :
                    ?>
                        <div class="recipe-section recipe-ingredients">
                            <h2 class="recipe-section-title">Ingredients</h2>
                            <div class="recipe-ingredients-list">
                                <?php echo wp_kses_post( wpautop( $ingredients ) ); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- DIRECTIONS SECTION -->
                    <?php
                    $directions = get_post_meta( get_the_ID(), 'recipe_directions', true );
                    if ( $directions ) :
                    ?>
                        <div class="recipe-section recipe-directions">
                            <h2 class="recipe-section-title">Directions</h2>
                            <div class="recipe-directions-list">
                                <?php echo wp_kses_post( wpautop( $directions ) ); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- TIPS SECTION -->
                    <?php
                    $tips = get_post_meta( get_the_ID(), 'recipe_tips', true );
                    if ( $tips ) :
                    ?>
                        <div class="recipe-section recipe-tips">
                            <h2 class="recipe-section-title">Tips</h2>
                            <div class="recipe-tips-list">
                                <?php echo wp_kses_post( wpautop( $tips ) ); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Additional Content from Main Editor -->
                    <?php the_content(); ?>

                </div>

                <!-- ============================================ -->
                <!-- RECIPE FOOTER -->
                <!-- ============================================ -->
                <footer class="entry-footer recipe-footer">
                    <?php
                    the_tags( '<div class="recipe-tags"><strong>Tags:</strong> ', ', ', '</div>' );
                    ?>
                </footer>

            </article>

            <?php
            // Comments Section
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
```

---

## 🎨 CSS STYLES

### Design System Variables

```css
:root {
    --foodica-primary: #e05454;           /* Foodica red */
    --foodica-primary-hover: #c54545;     /* Darker red for hover */
    --foodica-font-serif: 'Lora', Georgia, serif;
    --foodica-font-sans: 'Open Sans', system-ui, sans-serif;
    --foodica-bg: #ffffff;
    --foodica-text: #333333;
    --foodica-text-light: #999999;
    --foodica-gray-light: #f9f9f9;
    --foodica-gray-border: #eeeeee;
    --foodica-spacing: 30px;
    --foodica-spacing-sm: 15px;
    --foodica-spacing-lg: 60px;
    --foodica-border-radius: 0px;
    --foodica-transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    --foodica-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
```

### Recipe Post Styles

```css
/* 
=======================================================================
RECIPE POST TEMPLATE - SINGLE POST STYLING
=======================================================================
*/

/* Recipe Post Container */
.recipe-post {
    max-width: 900px;
    margin: 0 auto;
    padding: var(--foodica-spacing);
}

/* ============================================ */
/* RECIPE HEADER */
/* ============================================ */

.recipe-header {
    text-align: center;
    margin-bottom: var(--foodica-spacing-lg);
    padding-bottom: var(--foodica-spacing);
    border-bottom: 2px solid var(--foodica-gray-border);
}

.recipe-title {
    font-family: var(--foodica-font-serif);
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--foodica-text);
    line-height: 1.3;
    margin: 0 0 20px 0;
}

/* Recipe Meta (Timing & Nutrition Pills) */
.recipe-meta {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    margin: 20px 0;
    font-size: 0.95rem;
    color: var(--foodica-text-light);
}

.recipe-meta span {
    display: flex;
    align-items: center;
    padding: 8px 15px;
    background: var(--foodica-gray-light);
    border-radius: 20px;
}

.recipe-meta strong {
    color: var(--foodica-text);
    margin-right: 5px;
}

/* ============================================ */
/* FEATURED IMAGE */
/* ============================================ */

.recipe-featured-image {
    margin: 0 0 var(--foodica-spacing-lg) 0;
    border-radius: var(--foodica-border-radius);
    overflow: hidden;
    box-shadow: var(--foodica-shadow);
}

.recipe-main-image {
    width: 100%;
    height: auto;
    display: block;
}

/* ============================================ */
/* RECIPE INTRODUCTION */
/* ============================================ */

.recipe-introduction {
    font-size: 1.1rem;
    line-height: 1.8;
    color: var(--foodica-text);
    margin-bottom: var(--foodica-spacing-lg);
    text-align: left;
}

.recipe-introduction p {
    margin-bottom: 1.2em;
}

/* ============================================ */
/* RECIPE SECTIONS (Ingredients, Directions, Tips) */
/* ============================================ */

.recipe-section {
    margin-bottom: var(--foodica-spacing-lg);
    padding: var(--foodica-spacing);
    background: var(--foodica-gray-light);
    border-left: 4px solid var(--foodica-primary);
}

.recipe-section-title {
    font-family: var(--foodica-font-serif);
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--foodica-text);
    margin: 0 0 20px 0;
}

/* ============================================ */
/* INGREDIENTS LIST */
/* ============================================ */

.recipe-ingredients-list ul,
.recipe-ingredients-list ol {
    list-style: none;
    padding: 0;
    margin: 0;
}

.recipe-ingredients-list li {
    padding: 12px 0 12px 30px;
    position: relative;
    font-size: 1.05rem;
    line-height: 1.6;
    color: var(--foodica-text);
    border-bottom: 1px solid var(--foodica-gray-border);
}

.recipe-ingredients-list li:last-child {
    border-bottom: none;
}

/* Checkmark before each ingredient */
.recipe-ingredients-list li::before {
    content: "✓";
    position: absolute;
    left: 0;
    color: var(--foodica-primary);
    font-weight: 700;
    font-size: 1.2rem;
}

/* ============================================ */
/* DIRECTIONS LIST */
/* ============================================ */

.recipe-directions-list ol {
    counter-reset: step-counter;
    list-style: none;
    padding: 0;
    margin: 0;
}

.recipe-directions-list li {
    counter-increment: step-counter;
    padding: 20px 0 20px 50px;
    position: relative;
    font-size: 1.05rem;
    line-height: 1.8;
    color: var(--foodica-text);
    border-bottom: 1px solid var(--foodica-gray-border);
}

.recipe-directions-list li:last-child {
    border-bottom: none;
}

/* Numbered circles before each step */
.recipe-directions-list li::before {
    content: counter(step-counter);
    position: absolute;
    left: 0;
    top: 20px;
    width: 35px;
    height: 35px;
    background: var(--foodica-primary);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.1rem;
}

/* ============================================ */
/* TIPS LIST */
/* ============================================ */

.recipe-tips-list ul,
.recipe-tips-list ol {
    list-style: none;
    padding: 0;
    margin: 0;
}

.recipe-tips-list li {
    padding: 15px 0 15px 35px;
    position: relative;
    font-size: 1.05rem;
    line-height: 1.7;
    color: var(--foodica-text);
    border-bottom: 1px solid var(--foodica-gray-border);
}

.recipe-tips-list li:last-child {
    border-bottom: none;
}

/* Light bulb emoji before each tip */
.recipe-tips-list li::before {
    content: "💡";
    position: absolute;
    left: 0;
    font-size: 1.3rem;
}

/* ============================================ */
/* RECIPE FOOTER (Tags) */
/* ============================================ */

.recipe-footer {
    margin-top: var(--foodica-spacing-lg);
    padding-top: var(--foodica-spacing);
    border-top: 2px solid var(--foodica-gray-border);
}

.recipe-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 10px;
}

.recipe-tags a {
    display: inline-block;
    padding: 8px 15px;
    background: var(--foodica-gray-light);
    color: var(--foodica-text);
    text-decoration: none;
    border-radius: 20px;
    font-size: 0.9rem;
    transition: var(--foodica-transition);
}

.recipe-tags a:hover {
    background: var(--foodica-primary);
    color: white;
}

/* ============================================ */
/* ADDITIONAL CONTENT */
/* ============================================ */

.recipe-content > *:not(.recipe-section) {
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
}

/* ============================================ */
/* MOBILE RESPONSIVE */
/* ============================================ */

@media (max-width: 768px) {
    .recipe-title {
        font-size: 2rem;
    }
    
    .recipe-meta {
        flex-direction: column;
        gap: 10px;
    }
    
    .recipe-meta span {
        justify-content: center;
    }
    
    .recipe-section {
        padding: 20px 15px;
    }
    
    .recipe-section-title {
        font-size: 1.5rem;
    }
    
    .recipe-directions-list li {
        padding-left: 45px;
    }
    
    .recipe-directions-list li::before {
        width: 30px;
        height: 30px;
        font-size: 1rem;
    }
}

@media (max-width: 480px) {
    .recipe-post {
        padding: 15px;
    }
    
    .recipe-title {
        font-size: 1.6rem;
    }
    
    .recipe-introduction {
        font-size: 1rem;
    }
}
```

---

## 📊 VISUAL STRUCTURE DIAGRAM

```
┌─────────────────────────────────────────────────────────────┐
│                     RECIPE HEADER                           │
│  ┌─────────────────────────────────────────────────────┐   │
│  │  Recipe Title (2.5rem, serif, centered)             │   │
│  └─────────────────────────────────────────────────────┘   │
│                                                             │
│  ┌──────┐ ┌──────┐ ┌──────┐ ┌──────┐ ┌──────┐           │
│  │ Prep │ │ Cook │ │Total │ │Servs │ │Cals  │ (Pills)    │
│  └──────┘ └──────┘ └──────┘ └──────┘ └──────┘           │
│                                                             │
│  Categories • Date                                          │
│━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━│
├─────────────────────────────────────────────────────────────┤
│                  FEATURED IMAGE                             │
│  ┌─────────────────────────────────────────────────────┐   │
│  │                                                      │   │
│  │          [Full-width Recipe Image]                  │   │
│  │                                                      │   │
│  └─────────────────────────────────────────────────────┘   │
├─────────────────────────────────────────────────────────────┤
│                  INTRODUCTION                               │
│  2-3 paragraphs of engaging recipe description             │
│  1.1rem font, 1.8 line-height, left-aligned                │
├─────────────────────────────────────────────────────────────┤
│  ┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓   │
│  ┃ Ingredients                                         ┃   │
│  ┃ ━━━━━━━━━━━                                        ┃   │
│  ┃ ✓ 2 cups all-purpose flour                         ┃   │
│  ┃ ✓ 1 teaspoon baking powder                         ┃   │
│  ┃ ✓ 1/2 cup butter, softened                         ┃   │
│  ┃ ✓ ...                                              ┃   │
│  ┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛   │
├─────────────────────────────────────────────────────────────┤
│  ┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓   │
│  ┃ Directions                                          ┃   │
│  ┃ ━━━━━━━━━━                                         ┃   │
│  ┃  ①  Preheat oven to 350°F (175°C)                  ┃   │
│  ┃  ②  In a large bowl, mix flour and baking powder   ┃   │
│  ┃  ③  Add butter and stir until combined             ┃   │
│  ┃  ...                                               ┃   │
│  ┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛   │
├─────────────────────────────────────────────────────────────┤
│  ┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓   │
│  ┃ Tips                                                ┃   │
│  ┃ ━━━━                                               ┃   │
│  ┃  💡 For best results, use room temperature butter  ┃   │
│  ┃  💡 Store in airtight container for up to 5 days   ┃   │
│  ┃  💡 Can be frozen for up to 3 months               ┃   │
│  ┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛   │
├─────────────────────────────────────────────────────────────┤
│                    RECIPE FOOTER                            │
│  Tags: [dessert] [cookies] [easy] [chocolate]              │
└─────────────────────────────────────────────────────────────┘
```

---

## 🎯 KEY FEATURES

### Visual Design Elements
- **Centered header** with large serif title
- **Meta pills** with rounded corners for timing/nutrition
- **Full-width featured image** with shadow
- **Colored accent border** (red #e05454) on left of sections
- **Light gray background** (#f9f9f9) for recipe sections
- **Checkmarks** (✓) for ingredients in red
- **Numbered circles** (①②③) for directions in red
- **Light bulb emojis** (💡) for tips
- **Tag pills** that change to red on hover

### Typography
- **Title:** 2.5rem Lora (serif)
- **Section titles:** 1.8rem Lora (serif)
- **Body text:** 1.05rem Open Sans
- **Line heights:** 1.6-1.8 for readability

### Colors
- **Primary:** #e05454 (Foodica red)
- **Text:** #333333 (dark gray)
- **Light text:** #999999 (medium gray)
- **Background:** #f9f9f9 (light gray)
- **Borders:** #eeeeee (very light gray)

### Responsive Design
- **Desktop:** Full width (max 900px)
- **Tablet (768px):** Stacked meta, smaller titles
- **Mobile (480px):** Smaller fonts, compact spacing

---

## 🔧 DATA SOURCES

Recipe data comes from WordPress custom fields (post meta):
- `recipe_introduction` - Introduction text
- `recipe_prep_time` - Prep time string
- `recipe_cook_time` - Cook time string
- `recipe_total_time` - Total time string
- `recipe_servings` - Servings string
- `recipe_calories` - Calories string
- `recipe_ingredients` - Ingredients list (one per line)
- `recipe_directions` - Directions (numbered list)
- `recipe_tips` - Tips list

---

## 💡 ENHANCEMENT IDEAS FOR AI

Consider improving:
1. **Print button** - Add print-friendly version
2. **Social sharing** - Add share buttons
3. **Recipe rating** - Star rating system
4. **Jump to recipe** - Quick link button at top
5. **Nutrition table** - Expanded nutrition info
6. **Recipe video** - Video embed section
7. **Ingredient checkboxes** - Interactive shopping list
8. **Timer buttons** - Click to start cooking timers
9. **Serving adjuster** - Scale ingredients dynamically
10. **Recipe notes** - User-added notes section
11. **Related recipes** - Similar recipe suggestions
12. **Save to favorites** - Bookmark functionality
13. **Dietary icons** - Vegan, gluten-free, etc. badges
14. **Difficulty indicator** - Easy/medium/hard badge
15. **Cost estimate** - Price range indicator

---

## 📝 NOTES FOR AI ENHANCEMENT

- Maintain WordPress compatibility (PHP/WordPress functions)
- Keep mobile-first responsive design
- Use Foodica color scheme (#e05454 primary)
- Maintain accessibility (semantic HTML, ARIA labels)
- Ensure print-friendly styles
- Consider Schema.org Recipe markup for SEO
- Keep load time fast (optimize images, CSS)
- Test with various content lengths
- Ensure RTL (right-to-left) compatibility if needed
- Make enhancements optional/configurable

---

**File Location:** `wp-content/themes/foodica-child/single.php`  
**Stylesheet:** `wp-content/themes/foodica-child/style.css`  
**Theme:** Foodica Child - Professional  
**Date:** November 11, 2025
