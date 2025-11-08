# 📋 INSTALLATION CHECKLIST - Foodica Child Theme

Use this checklist to ensure proper installation and configuration of your Foodica Child Theme with AdSense integration.

---

## ✅ PRE-INSTALLATION

- [ ] **WordPress version 6.0+** is installed
- [ ] **PHP version 7.4+** is running on your server
- [ ] **Foodica parent theme (v1.3.1)** is installed
- [ ] **Required plugins installed:**
  - [ ] Recipe Card Blocks
  - [ ] Block Patterns for Food Bloggers
  - [ ] Instagram Widget by WPZOOM
  - [ ] Social Icons Widget by WPZOOM
  - [ ] WPZOOM Forms
- [ ] **AdSense account approved** and ready
- [ ] **Backup created** of your WordPress site

---

## 📁 STEP 1: UPLOAD CHILD THEME

- [ ] Downloaded/copied the `foodica-child` folder
- [ ] Verified folder contains these files:
  - [ ] `style.css`
  - [ ] `functions.php`
  - [ ] `front-page.php`
  - [ ] `README.md`
  - [ ] `ADSENSE-CODES.html`
- [ ] Uploaded folder to: `wp-content/themes/`
- [ ] Verified file permissions (644 for files, 755 for folders)

---

## 🎨 STEP 2: ACTIVATE CHILD THEME

- [ ] Logged into WordPress admin
- [ ] Navigated to: **Appearance → Themes**
- [ ] Found "Foodica Child" theme in list
- [ ] Clicked **Activate** button
- [ ] Verified activation success message
- [ ] Checked that site is still loading correctly

---

## 🏠 STEP 3: CONFIGURE HOMEPAGE

### Create Homepage
- [ ] Go to: **Pages → Add New**
- [ ] Title: "Home" (or your preferred name)
- [ ] Content: Leave blank (template handles everything)
- [ ] Click **Publish**

### Set Static Homepage
- [ ] Go to: **Settings → Reading**
- [ ] Select: **A static page**
- [ ] Homepage dropdown: Select "Home" page
- [ ] Click **Save Changes**

### Assign Template
- [ ] Go to: **Pages → All Pages**
- [ ] Edit the "Home" page
- [ ] Right sidebar → Page Attributes → Template
- [ ] Select: **Front Page**
- [ ] Click **Update**
- [ ] Visit your site homepage to verify it's working

---

## 💰 STEP 4: ADD ADSENSE CODES

### Get Your AdSense IDs
- [ ] Logged into [Google AdSense](https://www.google.com/adsense/)
- [ ] Found Publisher ID (ca-pub-XXXXXXXXXXXXXXXX)
- [ ] Created 3 new ad units:
  - [ ] Ad Unit 1: "Homepage Below Slider"
  - [ ] Ad Unit 2: "Homepage Between Content"
  - [ ] Ad Unit 3: "Homepage Above Footer"
- [ ] Copied each Ad Slot ID

### Add Codes to Widgets
- [ ] Go to: **Appearance → Widgets**

**Ad Slot 1 (Below Slider):**
- [ ] Found widget area: "Homepage Ad Slot 1"
- [ ] Dragged **Custom HTML** widget to this area
- [ ] Pasted AdSense code from ADSENSE-CODES.html
- [ ] Replaced `YOUR_PUBLISHER_ID` with real ID
- [ ] Replaced `YOUR_AD_SLOT_ID` with real ID
- [ ] Clicked **Save**

**Ad Slot 2 (Between Recipe Cards):**
- [ ] Found widget area: "Homepage Ad Slot 2"
- [ ] Dragged **Custom HTML** widget to this area
- [ ] Pasted AdSense code from ADSENSE-CODES.html
- [ ] Replaced `YOUR_PUBLISHER_ID` with real ID
- [ ] Replaced `YOUR_AD_SLOT_ID` with real ID
- [ ] Clicked **Save**

**Ad Slot 3 (Above Footer):**
- [ ] Found widget area: "Homepage Ad Slot 3"
- [ ] Dragged **Custom HTML** widget to this area
- [ ] Pasted AdSense code from ADSENSE-CODES.html
- [ ] Replaced `YOUR_PUBLISHER_ID` with real ID
- [ ] Replaced `YOUR_AD_SLOT_ID` with real ID
- [ ] Clicked **Save**

---

## 📝 STEP 5: CREATE CONTENT

### Create Categories
- [ ] Go to: **Posts → Categories**
- [ ] Created main categories:
  - [ ] Breakfast
  - [ ] Lunch
  - [ ] Dinner
  - [ ] Desserts
- [ ] Added category descriptions (optional)

### Create Featured Posts for Slider
- [ ] Go to: **Posts → Add New**
- [ ] Created at least 3 posts with:
  - [ ] Featured images (1200x600px recommended)
  - [ ] Assigned to "featured-recipes" category
  - [ ] Or marked as "Featured" in Foodica settings
  - [ ] Set status to **Published**

### Create Recipe Posts
- [ ] Created at least 6 recipe posts with:
  - [ ] Featured images (800x600px recommended)
  - [ ] Excerpts (short descriptions)
  - [ ] Assigned to appropriate categories
  - [ ] Set status to **Published**

---

## 📧 STEP 6: CONFIGURE NEWSLETTER (OPTIONAL)

- [ ] Signed up for newsletter service (Mailchimp, MailerLite, etc.)
- [ ] Generated embed form code
- [ ] Go to: **Appearance → Widgets**
- [ ] Found widget area: "Newsletter Sidebar" (if available)
- [ ] Added **Custom HTML** widget
- [ ] Pasted newsletter form code
- [ ] Tested subscription

---

## 📱 STEP 7: CONFIGURE INSTAGRAM FEED (OPTIONAL)

- [ ] Installed Instagram feed plugin (Smash Balloon or WPZOOM)
- [ ] Connected Instagram account
- [ ] Go to: **Appearance → Widgets**
- [ ] Found widget area: "Instagram Sidebar" (if available)
- [ ] Added Instagram widget
- [ ] Configured display settings
- [ ] Saved changes

---

## 🧪 STEP 8: TESTING

### Visual Testing
- [ ] Cleared browser cache
- [ ] Visited homepage in incognito/private mode
- [ ] Verified all sections display correctly:
  - [ ] Featured slider with 3 posts
  - [ ] Ad Slot 1 below slider
  - [ ] Welcome section with site name
  - [ ] Latest recipes grid (6 posts)
  - [ ] Ad Slot 2 after 3rd recipe
  - [ ] Newsletter signup box
  - [ ] Category grid (4 categories)
  - [ ] Ad Slot 3 above footer
  - [ ] Instagram feed (if configured)

### Mobile Testing
- [ ] Tested on actual mobile device (not just browser)
- [ ] Checked responsive layout at different widths
- [ ] Verified ads are responsive
- [ ] No horizontal scrolling
- [ ] All images load properly
- [ ] Navigation works correctly

### Desktop Testing
- [ ] Tested on Chrome browser
- [ ] Tested on Firefox browser
- [ ] Tested on Safari browser (if Mac)
- [ ] Verified hover effects work
- [ ] Checked ad sizes are appropriate
- [ ] All links work correctly

### AdSense Testing
- [ ] Waited 24-48 hours for ads to activate
- [ ] Ads display correctly (or show gray placeholders)
- [ ] No blank spaces or broken ad units
- [ ] Ads don't overflow container
- [ ] Ads load smoothly without layout shift

---

## ⚡ STEP 9: PERFORMANCE OPTIMIZATION

### Run PageSpeed Test
- [ ] Opened [PageSpeed Insights](https://pagespeed.web.dev/)
- [ ] Entered homepage URL
- [ ] Ran test for **Mobile**
- [ ] Ran test for **Desktop**

### Check Core Web Vitals
- [ ] **LCP (Largest Contentful Paint):** < 2.5s ✅
- [ ] **FID (First Input Delay):** < 100ms ✅
- [ ] **CLS (Cumulative Layout Shift):** < 0.1 ✅

### If Scores Are Low:
- [ ] Optimized images (WebP format, compressed)
- [ ] Installed caching plugin (WP Rocket, W3 Total Cache)
- [ ] Enabled lazy loading for images
- [ ] Minified CSS/JS files
- [ ] Used CDN (Cloudflare, BunnyCDN)
- [ ] Re-ran PageSpeed test

---

## 🔐 STEP 10: SECURITY & MAINTENANCE

### Security Checks
- [ ] Updated WordPress to latest version
- [ ] Updated all plugins to latest versions
- [ ] Updated parent Foodica theme to latest version
- [ ] Installed security plugin (Wordfence, Sucuri)
- [ ] Set strong admin password
- [ ] Limited login attempts
- [ ] Enabled SSL certificate (HTTPS)

### Backup Setup
- [ ] Installed backup plugin (UpdraftPlus, BackupBuddy)
- [ ] Configured automatic backups
- [ ] Tested backup restore process
- [ ] Stored backup offsite (Google Drive, Dropbox)

---

## 📊 STEP 11: ADSENSE MONITORING

### First Week
- [ ] Checked AdSense dashboard daily
- [ ] Verified impressions are being recorded
- [ ] Checked CTR (Click-Through Rate)
- [ ] Ensured no policy violations
- [ ] Reviewed earnings reports

### Optimization
- [ ] Experimented with ad sizes
- [ ] Tested different ad placements
- [ ] Analyzed which ad slots perform best
- [ ] Adjusted based on data
- [ ] Complied with AdSense policies

---

## 🐛 TROUBLESHOOTING

### If Homepage Doesn't Show Custom Template
- [ ] Verified "Front Page" template is selected
- [ ] Cleared WordPress cache
- [ ] Cleared browser cache
- [ ] Deactivated other plugins temporarily
- [ ] Checked for PHP errors in debug.log

### If Ads Don't Show
- [ ] Waited 24-48 hours for activation
- [ ] Verified Publisher ID is correct
- [ ] Verified Ad Slot IDs are correct
- [ ] Checked browser console for errors
- [ ] Confirmed AdSense account is approved
- [ ] Disabled ad blockers for testing

### If Layout Looks Broken
- [ ] Cleared all caches (WordPress, browser, CDN)
- [ ] Verified child theme is activated
- [ ] Checked for CSS conflicts
- [ ] Disabled plugins one by one
- [ ] Tested with default WordPress theme

---

## ✨ BONUS: CUSTOMIZATION

### Change Colors
- [ ] Edited `style.css` in child theme
- [ ] Modified CSS variables in `:root` section
- [ ] Saved changes
- [ ] Cleared cache
- [ ] Verified new colors display correctly

### Change Welcome Text
- [ ] Edited `front-page.php`
- [ ] Found welcome section (line ~135)
- [ ] Updated text content
- [ ] Saved file
- [ ] Cleared cache

### Add Custom CSS
- [ ] Go to: **Appearance → Customize → Additional CSS**
- [ ] Added custom styles
- [ ] Clicked **Publish**

---

## 🎉 FINAL CHECKLIST

- [ ] **Child theme activated** ✅
- [ ] **Homepage template assigned** ✅
- [ ] **3 AdSense ads placed** ✅
- [ ] **Content created** (posts, categories) ✅
- [ ] **Mobile responsive** verified ✅
- [ ] **Performance optimized** ✅
- [ ] **Security configured** ✅
- [ ] **Backups enabled** ✅
- [ ] **Tested on multiple browsers** ✅
- [ ] **AdSense monitoring active** ✅

---

## 📞 NEED HELP?

If you encounter issues:

1. **Check the README.md** - Comprehensive documentation
2. **Review ADSENSE-CODES.html** - Ad placement guide
3. **WordPress Forums** - Search for similar issues
4. **Foodica Documentation** - Theme-specific help
5. **AdSense Help Center** - Ad-related questions

---

## 🚀 YOU'RE DONE!

Congratulations! Your Foodica Child Theme with AdSense optimization is now fully installed and configured.

**Next Steps:**
- Create more recipe content
- Promote your site on social media
- Monitor AdSense performance
- Optimize based on analytics
- Keep everything updated

**Good luck with your food blog!** 🍳👨‍🍳
