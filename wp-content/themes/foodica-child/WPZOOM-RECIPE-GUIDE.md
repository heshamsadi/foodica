# WPZOOM RECIPE CARD - QUICK SETUP GUIDE

## Where To See Your Published Recipe

After you publish a recipe post with WPZOOM Recipe Card block, you can view it:

### 1. View Single Recipe Post
```
Method 1: Click "View Post" button after publishing
Method 2: Go to Posts → All Posts → Click on your recipe post title
Method 3: Go to http://food1.local/your-recipe-post-slug/
```

### 2. See All Recipes on Homepage
Your recipes will appear on the homepage in:
- **Homepage Slider** - If assigned to "Featured" category
- **Latest Recipes Grid** - Shows your 9 most recent posts
- **Blog Archive** - Default blog listing at http://food1.local

### 3. Check Recipe Archive
```
All recipes should be visible at:
- http://food1.local (homepage - blog listing)
- http://food1.local/category/recipes/ (if you have "Recipes" category)
```

---

## WPZOOM Recipe Card Setup Checklist

### ✅ Basic Recipe Post Structure

When creating a recipe post, make sure you have:

1. **Post Title** - Your recipe name (e.g., "Chocolate Chip Cookies")

2. **Recipe Card Block** - The WPZOOM block with:
   - Recipe name
   - Recipe description
   - Prep time
   - Cook time
   - Total time
   - Servings
   - Ingredients list
   - Instructions steps
   - Recipe image

3. **Featured Image** - Set in right sidebar (1200×600px recommended)

4. **Category** - Assign to a category:
   - "Recipes" (main category for /category/recipes/ archive)
   - "Featured" (if you want it in homepage slider)
   - Specific types: "Desserts", "Main Course", "Appetizers", etc.

5. **Tags** - Add relevant tags (optional but good for SEO)

6. **Excerpt** - Write a short description (or WordPress auto-generates it)

---

## How Recipe Cards Work With Your Theme

### On Homepage (front-page.php)

**If you set "Home" as homepage with "Professional Homepage" template:**

1. **Featured Slider Section** (top)
   - Shows 5 posts from "Featured" category
   - Displays: featured image, title, excerpt, meta

2. **Latest Recipes Grid** (middle)
   - Shows 9 most recent posts (including recipe posts)
   - 3-column grid layout
   - Displays: featured image, title, excerpt, category, date, read time

3. **Categories Section** (below recipes)
   - Shows 4 top categories
   - Click any category to see all recipes in that category

### On Single Recipe Post

When someone clicks your recipe, they see:
- Full recipe card (WPZOOM block styling)
- All recipe details (ingredients, instructions, times)
- Print button (WPZOOM feature)
- Jump to recipe button (WPZOOM feature)
- Post content before/after recipe card
- Comments section
- Related posts (if theme supports)

---

## Quick Test: Is Your Recipe Showing?

### Test 1: Check Recent Posts
```
Go to: http://food1.local
Expected: Your recipe post appears in blog listing
If using Professional Homepage: Recipe shows in "Latest Recipes" grid
```

### Test 2: Check Recipe Category
```
If you assigned "Recipes" category:
Go to: http://food1.local/category/recipes/
Expected: Your recipe post appears in this archive
```

### Test 3: Check Featured Slider
```
If you assigned "Featured" category:
Go to homepage
Expected: Recipe appears in top slider (rotating carousel)
```

### Test 4: Direct Link
```
Go to: Posts → All Posts
Find your recipe post
Hover over title → Click "View"
Expected: Opens your recipe post with full recipe card
```

---

## Common Issues & Solutions

### Issue: "I published a recipe but don't see it anywhere"

**Possible Causes:**

1. **Homepage Not Set Yet**
   - Problem: You're seeing default blog listing
   - Solution: Set "Home" page as static homepage (see PROJECT-REPORT.md section 8.3)

2. **Recipe Post is Draft**
   - Problem: Post not published
   - Solution: Go to Posts → All Posts → Make sure status is "Published" (not Draft/Pending)

3. **No Featured Image**
   - Problem: Recipe shows but no image
   - Solution: Edit post → Set Featured Image (right sidebar)

4. **No Category Assigned**
   - Problem: Recipe not showing in category archives
   - Solution: Edit post → Check at least one category (right sidebar)

---

### Issue: "Recipe card looks plain/unstyled"

**Possible Causes:**

1. **WPZOOM Plugin Not Active**
   - Solution: Go to Plugins → Activate "Recipe Card Blocks by WPZOOM"

2. **Cache Issue**
   - Solution: Hard refresh browser (Ctrl+Shift+R on Windows)

3. **Theme Conflict**
   - Solution: WPZOOM uses its own styling, should work with any theme

---

### Issue: "Recipe not in featured slider"

**Requirements for Slider:**

1. Create "Featured" category:
   ```
   Posts → Categories → Add New
   Name: Featured
   Slug: featured
   Save
   ```

2. Assign recipe to "Featured" category:
   ```
   Edit your recipe post
   Right sidebar → Categories
   Check "Featured"
   Update post
   ```

3. Make sure you have homepage set up:
   ```
   "Home" page must use "Professional Homepage" template
   Settings → Reading → Homepage set to "Home" page
   ```

---

## Recommended Recipe Post Workflow

### Step-by-Step: Creating Your First Recipe

1. **Go to Posts → Add New**

2. **Add Title**
   ```
   Example: "Classic Chocolate Chip Cookies"
   ```

3. **Add Introduction Text**
   ```
   Write 2-3 paragraphs about the recipe:
   - Why you love it
   - What makes it special
   - Tips or story behind it
   ```

4. **Add Recipe Card Block**
   ```
   Click (+) button → Search "Recipe Card"
   Or type: /recipe
   Select "WPZOOM Recipe Card"
   ```

5. **Fill Recipe Details**
   ```
   Recipe Name: Classic Chocolate Chip Cookies
   Description: Soft, chewy cookies with gooey chocolate chips
   
   Details:
   - Prep Time: 15 minutes
   - Cook Time: 12 minutes
   - Total Time: 27 minutes
   - Servings: 24 cookies
   - Difficulty: Easy
   
   Ingredients:
   - 2 1/4 cups all-purpose flour
   - 1 tsp baking soda
   - 1 cup butter, softened
   - etc.
   
   Instructions:
   1. Preheat oven to 375°F
   2. Mix flour and baking soda
   3. Cream butter and sugars
   etc.
   ```

6. **Upload Recipe Image**
   ```
   In recipe card block: Click "Upload Image"
   Choose high-quality photo of finished recipe
   ```

7. **Set Featured Image**
   ```
   Right sidebar → Featured Image → Set featured image
   Choose same or different image (1200×600px ideal)
   ```

8. **Assign Categories**
   ```
   Right sidebar → Categories
   Check: "Recipes" (main category)
   Check: "Desserts" (specific type)
   Check: "Featured" (if you want in slider)
   ```

9. **Add Tags**
   ```
   Right sidebar → Tags
   Add: chocolate, cookies, dessert, baking
   ```

10. **Write Excerpt** (Optional)
    ```
    Right sidebar → Excerpt
    Write 1-2 sentences summarizing recipe
    If blank, WordPress auto-generates from content
    ```

11. **Publish**
    ```
    Click "Publish" button (top right)
    Click "View Post" to see it live
    ```

---

## Where Recipes Appear on Your Site

### Homepage (if using Professional Homepage template)
```
✓ Featured Slider (top) - Shows 5 "Featured" category posts
✓ Latest Recipes Grid (middle) - Shows 9 most recent posts
✓ Categories (bottom) - Shows recipe categories
```

### Archive Pages
```
✓ http://food1.local/category/recipes/ - All recipes
✓ http://food1.local/category/desserts/ - Dessert recipes
✓ http://food1.local/category/main-course/ - Main dishes
✓ http://food1.local/tag/chocolate/ - Chocolate recipes
```

### Navigation Menu
```
✓ Header menu: "Recipes" link → Goes to /category/recipes/
✓ Categories widget: Shows all recipe categories
```

### Search
```
✓ Search widget: Users can search for recipes
✓ Recipe cards are searchable by ingredients, title, tags
```

---

## WPZOOM Recipe Card Features

### Built-in Features You Get:

1. **Jump to Recipe Button** - Skips intro text, goes straight to recipe
2. **Print Recipe Button** - Clean print-friendly version
3. **Recipe Schema Markup** - Google rich snippets (shows in search results)
4. **Adjustable Servings** - Users can scale recipe up/down
5. **Recipe Timer** - Built-in cooking timer
6. **Ingredient Checkboxes** - Users can check off ingredients as they cook
7. **Nutrition Facts** (Pro) - Automatic calculation (paid feature)
8. **Star Ratings** - Users can rate your recipes

### How It Looks in Google Search:

Your recipes will show rich snippets with:
- ⭐ Star rating
- 🕐 Cook time
- 📊 Calories (if added)
- 👤 Recipe author
- 📸 Recipe image

This increases click-through rate from search results!

---

## Current Status Check

Let me help you verify your setup. Please check:

### 1. Is your recipe post published?
```
Go to: Posts → All Posts
Find your recipe
Status column should say: "Published" (not Draft)
```

### 2. Does it have a featured image?
```
In All Posts list, you should see a small image thumbnail
If blank square: No featured image set
```

### 3. What category is it in?
```
Hover over recipe in All Posts
Check "Categories" column
Should show at least one category
```

### 4. Can you view it directly?
```
In All Posts, hover over recipe title
Click "View"
Does it open and show the recipe card?
```

---

## Next Steps

1. **Tell me what you see:**
   - Did you publish the recipe? (yes/no)
   - What's the recipe post title?
   - Did you assign it to "Recipes" category?
   - Does it have a featured image?

2. **I'll help you:**
   - Check if recipe is visible
   - Set up homepage correctly to show recipes
   - Create "Featured" category for slider
   - Verify recipe card is displaying properly

3. **To see recipe immediately:**
   ```
   Quick way: Go to Posts → All Posts
   Find your recipe → Hover → Click "View"
   This opens the recipe post directly
   ```

---

**What's the title of your recipe post? I'll help you verify it's set up correctly.**
