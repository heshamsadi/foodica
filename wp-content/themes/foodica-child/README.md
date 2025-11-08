# Foodica Child - Professional Homepage Theme

A professional child theme for Foodica that delivers a stunning, user-focused homepage design while maintaining 100% compatibility with Foodica's native design system.

## Features

✨ **Professional Design**
- Clean, modern homepage layout
- 6 customizable content sections
- Responsive design (mobile, tablet, desktop)
- Matches Foodica's design system perfectly

📱 **Mobile-Optimized**
- Responsive grid layouts
- Touch-friendly navigation
- Optimized images with lazy loading
- Fast loading on all devices

🎨 **Customizable Sections**
- Featured posts slider (5 posts)
- Welcome hero with site branding
- Latest recipes grid (9 posts, 3 columns)
- Category showcase (4 categories)
- Newsletter signup box
- Instagram feed integration

⚡ **Performance-First**
- Proper CSS/JS enqueuing
- Lazy-loaded images
- Content visibility optimizations
- Minimal database queries

## Installation

### Step 1: Upload Child Theme

1. **Download the child theme files** (or create the folder structure):
   - `style.css`
   - `functions.php`
   - `front-page.php`
   - `README.md` (this file)

2. **Upload via FTP/File Manager**:
   - Connect to your server via FTP or cPanel File Manager
   - Navigate to: `wp-content/themes/`
   - Create folder: `foodica-child`
   - Upload all 4 files to `wp-content/themes/foodica-child/`

3. **OR Upload via WordPress Admin**:
   - Compress the `foodica-child` folder to a ZIP file
   - Go to: **Appearance → Themes → Add New → Upload Theme**
   - Select the ZIP file and click "Install Now"

### Step 2: Activate Child Theme

1. Go to **Appearance → Themes**
2. Find "Foodica Child - Professional"
3. Click **Activate**

⚠️ **Important**: Make sure the parent Foodica theme is installed (it doesn't need to be active, just installed).

### Step 3: Create Homepage

1. **Create a new page**:
   - Go to **Pages → Add New**
   - Title: "Home" (or any name you prefer)
   - **Template**: Select "Professional Homepage" from Page Attributes
   - Click **Publish**

2. **Set as homepage**:
   - Go to **Settings → Reading**
   - Select "A static page (select below)"
   - Choose your "Home" page for "Homepage"
   - Click **Save Changes**

### Step 4: Configure Content

#### A. Featured Posts Slider

The slider displays 5 posts tagged as "featured". To populate it:

1. **Create "Featured" category**:
   - Go to **Posts → Categories**
   - Add new category: Name = "Featured"
   - Click **Add New Category**

2. **Tag 5+ posts as featured**:
   - Edit any post
   - Check the "Featured" category
   - Update the post
   - Repeat for 4-5 more posts

3. **Add featured images**:
   - Each featured post should have a large image (1200×600px recommended)
   - Go to **Posts → Edit Post → Set Featured Image**

**Alternative**: If your Foodica theme has the native slider enabled, it will use that automatically.

#### B. Recipe Categories

The homepage displays your top 4 categories by post count:

1. **Create categories**:
   - Go to **Posts → Categories**
   - Create 4+ categories (e.g., "Breakfast", "Dinner", "Desserts", "Quick Meals")

2. **Add category images** (optional):
   - Install a plugin like "Category Thumbnails" or "Categories Images"
   - Upload images for each category (600×400px recommended)
   - The theme will automatically display them

3. **Publish posts**:
   - Assign posts to these categories
   - The homepage will show the 4 most popular categories

#### C. Latest Recipes Grid

Automatically displays your 9 most recent posts. No configuration needed!

### Step 5: Configure Widgets (Optional)

The child theme provides 6 widget areas for additional content:

| Widget Area | Purpose | Recommended Content |
|------------|---------|---------------------|
| **Home Welcome** | Below welcome message | Call-to-action buttons, featured links |
| **Home Featured Slider** | Below slider | Announcement banner, featured content |
| **Home Recipes Grid** | Within recipe grid | Custom HTML, promotional boxes |
| **Home Categories** | Below categories | Social media links, custom content |
| **Home Newsletter** | Newsletter section | MailChimp, ConvertKit, or custom form |
| **Home Instagram** | Instagram section | WPZOOM Social Feed or similar plugin |

To configure widgets:

1. Go to **Appearance → Widgets**
2. Find the widget areas listed above
3. Drag widgets into the areas you want to use

#### Newsletter Setup Example

1. Install your preferred email marketing plugin:
   - MailChimp for WordPress
   - ConvertKit
   - Newsletter plugin
   - Or use custom HTML/form

2. Go to **Appearance → Widgets**
3. Find **Home Newsletter** widget area
4. Add your newsletter form widget
5. Configure the form settings in the plugin

#### Instagram Feed Setup Example

1. Install **WPZOOM Social Feed Widget** (recommended) or **Smash Balloon Instagram Feed**
2. Configure your Instagram account connection
3. Go to **Appearance → Widgets**
4. Add the Instagram widget to **Home Instagram** area
5. Set display options (number of photos, columns, etc.)

## Customization

### Change Colors

The theme uses Foodica's color scheme by default. To customize colors:

1. Go to **Appearance → Customize → Colors**
2. Adjust the primary color (default: #e05454)
3. Or edit `style.css` `:root` variables:

```css
:root {
    --foodica-primary: #e05454;          /* Primary color */
    --foodica-primary-hover: #c54545;    /* Hover state */
    --foodica-text: #333333;             /* Body text */
    --foodica-text-light: #999999;       /* Meta text */
}
```

### Change Welcome Message

Edit `front-page.php`, find the "Welcome Hero" section (around line 70):

```php
<h1><?php printf( __( 'Welcome to %s', 'foodica-child' ), get_bloginfo( 'name' ) ); ?></h1>
```

Replace with your custom message:

```php
<h1><?php esc_html_e( 'Your Custom Welcome Message', 'foodica-child' ); ?></h1>
```

### Change Section Titles

Edit `front-page.php` and find these lines:

```php
<h2 class="section-title"><?php esc_html_e( 'Latest Kitchen Creations', 'foodica-child' ); ?></h2>
<h2 class="section-title"><?php esc_html_e( 'Browse by Category', 'foodica-child' ); ?></h2>
<h2><?php esc_html_e( 'Get Recipes in Your Inbox', 'foodica-child' ); ?></h2>
```

### Change Number of Posts/Categories

Edit these values in `front-page.php`:

```php
// Change number of slider posts (default: 5)
$slider_posts = foodica_child_slider_posts( 5 ); // Change 5 to any number

// Change number of recipe cards (default: 9)
'posts_per_page' => 9, // Change 9 to 6, 12, 15, etc.

// Change number of categories (default: 4)
'number' => 4, // Change 4 to any number
```

### Change Grid Columns

Edit `style.css` to change the recipe grid layout:

```css
.recipes-grid {
    grid-template-columns: repeat(3, 1fr); /* 3 columns on desktop */
}

@media screen and (max-width: 1024px) {
    .recipes-grid {
        grid-template-columns: repeat(2, 1fr); /* 2 columns on tablet */
    }
}

@media screen and (max-width: 768px) {
    .recipes-grid {
        grid-template-columns: 1fr; /* 1 column on mobile */
    }
}
```

## Troubleshooting

### Homepage Not Showing

**Problem**: After activation, homepage looks the same.

**Solution**:
1. Make sure you created a page with "Professional Homepage" template (Step 3)
2. Verify it's set as homepage in **Settings → Reading**
3. Clear browser cache and hard refresh (Ctrl+Shift+R)

### Slider Not Showing

**Problem**: Featured slider section is empty.

**Solutions**:
- **Option 1**: Create a "Featured" category and assign 5+ posts to it
- **Option 2**: Enable Foodica's native slider: **Appearance → Customize → Homepage Settings → Featured Posts**
- **Option 3**: Disable the slider by commenting out lines 21-80 in `front-page.php`

### Categories Have No Images

**Problem**: Category blocks show gray backgrounds instead of images.

**Solutions**:
1. Install "Categories Images" or "Category Thumbnails" plugin
2. Go to **Posts → Categories**
3. Edit each category and upload a thumbnail image (600×400px recommended)
4. Or the theme will use a placeholder gray background (this is normal)

### Widget Areas Not Showing

**Problem**: Widget areas don't appear in **Appearance → Widgets**.

**Solution**:
1. Make sure child theme is activated (not just installed)
2. Deactivate and reactivate the child theme
3. Clear any caching plugins (W3 Total Cache, WP Super Cache, etc.)

### CSS Not Loading

**Problem**: Homepage looks broken or unstyled.

**Solutions**:
1. Clear browser cache (Ctrl+Shift+R)
2. Clear WordPress cache if using a caching plugin
3. Check that `style.css` has this header at the top:
   ```css
   /*
   Theme Name: Foodica Child - Professional
   Template: foodica
   */
   ```
4. Verify parent Foodica theme is installed

### Posts Not Showing

**Problem**: "No recipes found" message appears.

**Solution**:
1. Publish at least 9 posts (they can be test posts)
2. Make sure posts are set to "Published" status (not drafts)
3. Verify posts are in the "Posts" post type (not pages)

## Theme File Structure

```
foodica-child/
├── style.css           # Child theme styles (CSS)
├── functions.php       # Theme functionality (PHP)
├── front-page.php      # Homepage template (PHP)
└── README.md          # This documentation
```

## Support & Credits

**Theme**: Foodica Child - Professional  
**Parent Theme**: Foodica by WPZOOM  
**Version**: 1.0.0  
**License**: GPL v3 or later

**Built with**:
- 100% compatibility with Foodica's design system
- Semantic HTML5 markup
- CSS Grid and Flexbox layouts
- WordPress coding standards
- Performance best practices

## Changelog

### Version 1.0.0 (2025-01-XX)
- Initial release
- Professional homepage template with 6 sections
- 6 widget areas for customization
- Responsive design (mobile, tablet, desktop)
- Performance optimizations (lazy loading, content visibility)
- Helper functions (read time, category backgrounds, slider query)

---

**Need help?** Check the Troubleshooting section above or refer to [Foodica theme documentation](https://www.wpzoom.com/documentation/foodica/).

**Enjoy your new professional homepage!** 🎉
