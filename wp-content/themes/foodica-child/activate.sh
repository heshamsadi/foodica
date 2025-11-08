#!/bin/bash

# Foodica Child Theme - One-Command Activation
# This script activates the theme and triggers all automated setup

echo "🚀 Activating Foodica Child Theme..."
echo ""

# Navigate to WordPress root
cd "c:/Users/7maydouch/Local Sites/food1/app/public"

# Activate the child theme
wp theme activate foodica-child

echo ""
echo "✅ Theme activated!"
echo ""
echo "🤖 Automated setup completed:"
echo "   - Created 4 essential pages (About, Contact, Privacy, Disclaimer)"
echo "   - Created 2 navigation menus (Primary & Footer)"
echo "   - Assigned menus to locations"
echo "   - Set privacy policy page"
echo ""
echo "📋 Verification:"
echo ""

# List created pages
echo "📄 Pages created:"
wp post list --post_type=page --fields=post_title,post_name,post_status --format=table

echo ""

# List created menus
echo "🔗 Menus created:"
wp menu list --format=table

echo ""
echo "🎉 All done! Visit your site:"
echo "   Homepage: http://food1.local"
echo "   About: http://food1.local/about/"
echo "   Contact: http://food1.local/contact/"
echo ""
echo "📝 Next steps:"
echo "   1. Publish 20-30 recipe posts"
echo "   2. Add featured images to posts"
echo "   3. Create 'Featured' category for slider"
echo "   4. Buy a real domain (AdSense requirement)"
echo "   5. Apply for Google AdSense"
echo ""
