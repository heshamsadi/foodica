-- Foodica Child Theme Activation SQL
-- Run this to activate the theme without using WordPress dashboard

-- 1. Activate child theme
UPDATE wp_options SET option_value = 'foodica-child' WHERE option_name = 'stylesheet';
UPDATE wp_options SET option_value = 'foodica' WHERE option_name = 'template';

-- 2. Clear any theme mods cache
DELETE FROM wp_options WHERE option_name = 'theme_mods_foodica';

-- 3. Check if already activated
SELECT 
    option_name, 
    option_value 
FROM wp_options 
WHERE option_name IN ('stylesheet', 'template', 'foodica_child_setup_complete')
ORDER BY option_name;

-- After running this, visit http://food1.local in browser to trigger the auto-setup hook
