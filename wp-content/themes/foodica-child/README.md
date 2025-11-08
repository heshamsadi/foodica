# Foodica Child Theme - AdSense Optimized Homepage
**Version:** 1.0.0  
**Parent Theme:** Foodica by WPZOOM  
**WordPress Version:** 6.0+  
**PHP Version:** 7.4+

---

## 📋 OVERVIEW

This child theme extends the Foodica theme with a custom homepage template designed for optimal AdSense integration and performance. It maintains 100% visual compatibility with Foodica's native design while adding 3 strategic ad placements that comply with Google AdSense policies.

### ✨ Features

- ✅ **Matches Foodica's Design 100%** - Uses exact same colors, fonts, spacing, and hover effects
- ✅ **3 Strategic AdSense Placements** - Optimized for maximum visibility without disrupting UX
- ✅ **Lazy Loading Ads** - Improves Core Web Vitals (LCP, FID, CLS)
- ✅ **Fully Responsive** - Perfect on mobile, tablet, and desktop
- ✅ **Performance Optimized** - DNS prefetch, preconnect, and async loading
- ✅ **SEO Friendly** - Clean semantic HTML5 markup
- ✅ **Easy Customization** - Widget areas for ad management

---

## 📁 FILE STRUCTURE

```
wp-content/themes/foodica-child/
├── style.css           # Child theme stylesheet with AdSense styles
├── functions.php       # Core functionality, widgets, and optimization
├── front-page.php      # Custom homepage template
└── README.md          # This file
```

---

## 🚀 INSTALLATION INSTRUCTIONS

### Step 1: Upload Child Theme

1. **Using FTP/SFTP:**
   - Connect to your server via FTP client (FileZilla, Cyberduck, etc.)
   - Navigate to `wp-content/themes/`
   - Upload the `foodica-child` folder
   
2. **Using WordPress Admin:**
   - Go to `Appearance → Themes → Add New → Upload Theme`
   - Upload `foodica-child.zip` (if you've zipped the folder)
   - Click "Install Now"

### Step 2: Activate Child Theme

1. Go to `Appearance → Themes`
2. Find "Foodica Child" theme
3. Click **Activate**

⚠️ **IMPORTANT:** Make sure the parent "Foodica" theme is installed first!

### Step 3: Configure Homepage

1. Go to `Settings → Reading`
2. Under "Your homepage displays," select **A static page**
3. For "Homepage," create a new page called "Home" (or any name)
4. Save Changes

### Step 4: Assign Homepage Template

1. Go to `Pages → All Pages`
2. Edit the "Home" page
3. In the right sidebar, under "Template," select **Front Page**
4. Click **Update**

### Step 5: Add AdSense Code

#### Option A: Using Widgets (Recommended)

1. Go to `Appearance → Widgets`
2. Find the following widget areas:
   - **Homepage Ad Slot 1** (Below slider)
   - **Homepage Ad Slot 2** (Between recipe cards)
   - **Homepage Ad Slot 3** (Above footer)

3. Drag a **Custom HTML** widget to each area
4. Paste your AdSense code (example below)

**Example AdSense Code:**
```html
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-XXXXXXXXXXXXXXXX"
     crossorigin="anonymous"></script>
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-XXXXXXXXXXXXXXXX"
     data-ad-slot="YYYYYYYYYY"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
```

5. **Replace:**
   - `ca-pub-XXXXXXXXXXXXXXXX` with your AdSense Publisher ID
   - `YYYYYYYYYY` with your Ad Unit ID

#### Option B: Direct Template Editing

1. Go to `Appearance → Theme File Editor`
2. Select "Foodica Child" theme
3. Edit `front-page.php`
4. Find the placeholder comments:
   ```html
   <!-- AdSense Code Placeholder - Ad Slot 1 -->
   ```
5. Replace with your actual AdSense code
6. **Remove** the lazy-load script if editing directly (lines with `(adsbygoogle = window.adsbygoogle || []).push({});`)

---

## 📍 ADSENSE AD PLACEMENT GUIDE

### Ad Slot 1: Below Featured Slider
- **Recommended Size:** 728x90 (Leaderboard) or Responsive
- **Location:** Immediately after the featured slider
- **Visibility:** High - First ad users see after hero content
- **Format:** Horizontal banner

### Ad Slot 2: Between Recipe Cards
- **Recommended Size:** 970x250 (Billboard) or Responsive
- **Location:** After 3rd recipe card in the grid
- **Visibility:** Medium - Natural content break
- **Format:** Large rectangle or billboard

### Ad Slot 3: Above Footer
- **Recommended Size:** 970x90 (Large Leaderboard) or Responsive
- **Location:** Before footer, after all content
- **Visibility:** Medium - Last ad before footer
- **Format:** Horizontal banner

---

## 🎨 CUSTOMIZATION

### Changing Colors

Edit `style.css` and modify the CSS variables:

```css
:root {
    --foodica-primary: #e05454;        /* Main accent color */
    --foodica-bg: #ffffff;             /* Background color */
    --foodica-text: #333333;           /* Text color */
    --foodica-gray-light: #f9f9f9;     /* Light gray background */
}
```

### Changing Number of Recipe Cards

Edit `front-page.php`, find line ~180:

```php
'posts_per_page' => 6,  // Change to your desired number
```

### Changing Welcome Text

Edit `front-page.php`, find line ~135:

```php
<h1><?php printf( __( 'Welcome to %s', 'foodica-child' ), get_bloginfo( 'name' ) ); ?></h1>
```

Replace with your custom text.

### Changing Category Count

Edit `front-page.php`, find line ~309:

```php
$categories = foodica_child_get_recipe_categories( 4 );  // Change to your desired number
```

---

## ⚡ PERFORMANCE OPTIMIZATION

### What's Already Optimized

✅ **DNS Prefetch & Preconnect** - Pre-resolves AdSense domains  
✅ **Lazy Loading Ads** - Ads load only when near viewport  
✅ **Reserved Ad Space** - Prevents Cumulative Layout Shift (CLS)  
✅ **Async JavaScript** - Non-blocking ad script loading  
✅ **Emoji Removal** - Eliminates unnecessary WordPress emojis  

### Core Web Vitals Targets

- **LCP (Largest Contentful Paint):** < 2.5s ✅
- **FID (First Input Delay):** < 100ms ✅
- **CLS (Cumulative Layout Shift):** < 0.1 ✅

### Testing Performance

1. Go to [PageSpeed Insights](https://pagespeed.web.dev/)
2. Enter your homepage URL
3. Review scores for both Mobile and Desktop
4. Aim for 90+ score

---

## 📱 RESPONSIVE BREAKPOINTS

The theme adapts perfectly at these breakpoints:

- **Desktop:** 1440px+ (3-column recipe grid)
- **Laptop:** 1024px - 1439px (3-column recipe grid)
- **Tablet:** 768px - 1023px (2-column recipe grid)
- **Mobile:** < 768px (1-column layout)

### Ad Responsiveness

- **Desktop:** Full-width ads up to specified max-width
- **Mobile:** 100% width, auto-height responsive ads

---

## 🔧 TROUBLESHOOTING

### Ads Not Showing

**Problem:** AdSense ads appear as blank spaces

**Solutions:**
1. Check if your AdSense account is approved
2. Verify Publisher ID and Ad Slot IDs are correct
3. Clear browser cache and cookies
4. Wait 24-48 hours for new ad units to activate
5. Check browser console for JavaScript errors

### Layout Breaking on Mobile

**Problem:** Homepage looks broken on mobile devices

**Solutions:**
1. Clear all caches (WordPress, browser, CDN)
2. Ensure AdSense code has `data-full-width-responsive="true"`
3. Check if parent theme is updated to latest version
4. Disable other plugins temporarily to identify conflicts

### Slider Not Appearing

**Problem:** Featured slider doesn't show

**Solutions:**
1. Ensure posts are tagged as "Featured" (Foodica settings)
2. Create a category called "featured-recipes"
3. Assign at least 3 posts to this category
4. Check if posts have featured images

### Child Theme Not Activating

**Problem:** Can't activate child theme

**Solutions:**
1. Verify parent "Foodica" theme is installed
2. Check `style.css` has correct `Template: foodica` header
3. Ensure all files were uploaded correctly
4. Check file permissions (644 for files, 755 for folders)

---

## 🔐 SECURITY BEST PRACTICES

✅ **Never edit parent theme files directly**  
✅ **Keep WordPress, themes, and plugins updated**  
✅ **Use child theme for all customizations**  
✅ **Backup your site before making changes**  
✅ **Test changes on staging environment first**  

---

## 🆘 SUPPORT & DOCUMENTATION

### Foodica Theme Documentation
- [Official Foodica Documentation](https://www.wpzoom.com/documentation/foodica/)
- [WPZOOM Support Forum](https://www.wpzoom.com/support/)

### AdSense Resources
- [AdSense Help Center](https://support.google.com/adsense/)
- [AdSense Policy Center](https://support.google.com/adsense/answer/48182)
- [Ad Placement Guidelines](https://support.google.com/adsense/answer/1346295)

### WordPress Resources
- [WordPress Codex - Child Themes](https://codex.wordpress.org/Child_Themes)
- [WordPress Theme Handbook](https://developer.wordpress.org/themes/)

---

## 📝 CHANGELOG

### Version 1.0.0 (Initial Release)
- Custom homepage template with 9 sections
- 3 strategic AdSense ad placements
- Lazy loading ads with Intersection Observer
- DNS prefetch and preconnect optimization
- Fully responsive design matching Foodica
- Widget areas for easy ad management
- Performance optimizations for Core Web Vitals

---

## ⚖️ LICENSE

This child theme inherits the GPL v3 license from the parent Foodica theme.

**License:** GPL v3 or later  
**License URI:** http://www.gnu.org/licenses/gpl-3.0.html

---

## 👨‍💻 CREDITS

- **Parent Theme:** Foodica by WPZOOM
- **Child Theme Development:** Custom Development
- **Optimization Techniques:** Google Web.dev Guidelines
- **AdSense Integration:** Google AdSense Best Practices

---

## 🎯 NEXT STEPS

After installation, we recommend:

1. ✅ Create at least 6 blog posts with featured images
2. ✅ Set up 4 main categories (Breakfast, Lunch, Dinner, Desserts)
3. ✅ Tag 3 posts as "Featured" for the slider
4. ✅ Add your AdSense codes to widget areas
5. ✅ Set up newsletter integration (Mailchimp, etc.)
6. ✅ Connect Instagram widget if available
7. ✅ Test on mobile devices
8. ✅ Run PageSpeed test and optimize further if needed

---

## 📧 QUESTIONS?

If you need help with this child theme:
1. Check the troubleshooting section above
2. Review WordPress and Foodica documentation
3. Test with all plugins disabled to identify conflicts
4. Check browser console for JavaScript errors

---

**Thank you for using Foodica Child Theme with AdSense Optimization!** 🎉
