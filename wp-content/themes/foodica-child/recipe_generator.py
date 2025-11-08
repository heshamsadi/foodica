"""
AUTOMATED RECIPE POST GENERATOR
WordPress Recipe Blog System - Production Ready

This script automatically creates recipe posts in WordPress.
Perfect for bulk content creation and bot automation.

Requirements:
- WordPress with REST API enabled
- Application password for authentication
- Python 3.7+

Install: pip install requests python-dotenv
"""

import requests
import json
from typing import Dict, List, Optional
from datetime import datetime
import base64

class RecipePostGenerator:
    """Professional recipe post generator for WordPress"""
    
    def __init__(self, wp_url: str, username: str, app_password: str):
        """
        Initialize with WordPress credentials
        
        Args:
            wp_url: WordPress site URL (e.g., 'https://yoursite.com')
            username: WordPress username
            app_password: Application password (not regular password)
        """
        self.wp_url = wp_url.rstrip('/')
        self.api_url = f"{self.wp_url}/wp-json/wp/v2"
        
        # Create authentication header
        credentials = f"{username}:{app_password}"
        token = base64.b64encode(credentials.encode()).decode()
        self.headers = {
            'Authorization': f'Basic {token}',
            'Content-Type': 'application/json'
        }
        
        self.categories = {}
        self.tags = {}
        self._load_categories()
    
    def _load_categories(self):
        """Load existing categories and create 'Recipes' if needed"""
        try:
            response = requests.get(f"{self.api_url}/categories", headers=self.headers)
            for cat in response.json():
                self.categories[cat['name'].lower()] = cat['id']
            
            # Create Recipes category if it doesn't exist
            if 'recipes' not in self.categories:
                self._create_category('Recipes', 'recipes')
        except Exception as e:
            print(f"Warning: Could not load categories: {e}")
    
    def _create_category(self, name: str, slug: str) -> int:
        """Create a new category"""
        data = {'name': name, 'slug': slug}
        response = requests.post(
            f"{self.api_url}/categories",
            headers=self.headers,
            json=data
        )
        cat_id = response.json()['id']
        self.categories[name.lower()] = cat_id
        return cat_id
    
    def _get_or_create_tag(self, tag_name: str) -> int:
        """Get existing tag ID or create new tag"""
        tag_lower = tag_name.lower()
        
        if tag_lower in self.tags:
            return self.tags[tag_lower]
        
        # Search for existing tag
        response = requests.get(
            f"{self.api_url}/tags",
            params={'search': tag_name},
            headers=self.headers
        )
        
        tags = response.json()
        if tags:
            tag_id = tags[0]['id']
            self.tags[tag_lower] = tag_id
            return tag_id
        
        # Create new tag
        response = requests.post(
            f"{self.api_url}/tags",
            headers=self.headers,
            json={'name': tag_name}
        )
        tag_id = response.json()['id']
        self.tags[tag_lower] = tag_id
        return tag_id
    
    def format_recipe_html(self, recipe: Dict) -> str:
        """
        Format recipe data into beautiful HTML
        
        Args:
            recipe: Dictionary with recipe data
            
        Returns:
            Formatted HTML string
        """
        ingredients_html = '\n'.join([f"• {ing}" for ing in recipe['ingredients']])
        
        directions_html = '\n'.join([
            f"{i}️⃣ {step}" 
            for i, step in enumerate(recipe['directions'], 1)
        ])
        
        tips_html = '\n'.join([f"• {tip}" for tip in recipe.get('tips', [])])
        
        html = f"""{recipe.get('intro', '')}

<strong>Ingredients:</strong>
{ingredients_html}

<strong>Directions:</strong>
{directions_html}
"""
        
        if recipe.get('tips'):
            html += f"""
<strong>Tips:</strong>
{tips_html}
"""
        
        html += f"""
<strong>Preparation time:</strong> {recipe.get('prep_time', 'N/A')}
<strong>Cooking time:</strong> {recipe.get('cook_time', 'N/A')}
<strong>Total time:</strong> {recipe.get('total_time', 'N/A')}
<strong>Calories:</strong> {recipe.get('calories', 'N/A')} per serving
<strong>Servings:</strong> {recipe.get('servings', 'N/A')}
"""
        
        return html
    
    def create_recipe_post(
        self,
        recipe: Dict,
        status: str = 'publish',
        featured_image_url: Optional[str] = None
    ) -> Dict:
        """
        Create a recipe post in WordPress
        
        Args:
            recipe: Dictionary with recipe data (title, intro, ingredients, etc.)
            status: 'publish', 'draft', or 'pending'
            featured_image_url: URL of featured image (optional)
            
        Returns:
            Created post data including URL and ID
        """
        # Format content
        content = self.format_recipe_html(recipe)
        
        # Get category ID
        category_id = self.categories.get('recipes')
        if not category_id:
            category_id = self._create_category('Recipes', 'recipes')
        
        # Get tag IDs
        tag_ids = [self._get_or_create_tag(tag) for tag in recipe.get('tags', [])]
        
        # Create post data
        post_data = {
            'title': recipe['title'],
            'content': content,
            'status': status,
            'categories': [category_id],
            'tags': tag_ids
        }
        
        # Create excerpt if provided
        if recipe.get('intro'):
            # Take first 150 characters as excerpt
            excerpt = recipe['intro'][:150] + '...' if len(recipe['intro']) > 150 else recipe['intro']
            post_data['excerpt'] = excerpt
        
        # Create the post
        response = requests.post(
            f"{self.api_url}/posts",
            headers=self.headers,
            json=post_data
        )
        
        if response.status_code not in [200, 201]:
            raise Exception(f"Failed to create post: {response.text}")
        
        post = response.json()
        
        # Upload featured image if provided
        if featured_image_url:
            try:
                self._set_featured_image(post['id'], featured_image_url)
            except Exception as e:
                print(f"Warning: Could not set featured image: {e}")
        
        return {
            'id': post['id'],
            'url': post['link'],
            'title': post['title']['rendered'],
            'status': post['status']
        }
    
    def _set_featured_image(self, post_id: int, image_url: str):
        """Upload and set featured image for post"""
        # Download image
        img_response = requests.get(image_url)
        if img_response.status_code != 200:
            raise Exception("Could not download image")
        
        # Upload to WordPress
        files = {'file': img_response.content}
        headers = self.headers.copy()
        headers.pop('Content-Type')
        
        upload_response = requests.post(
            f"{self.api_url}/media",
            headers=headers,
            files=files
        )
        
        media_id = upload_response.json()['id']
        
        # Set as featured image
        requests.post(
            f"{self.api_url}/posts/{post_id}",
            headers=self.headers,
            json={'featured_media': media_id}
        )
    
    def bulk_create_recipes(self, recipes: List[Dict], delay: int = 2) -> List[Dict]:
        """
        Create multiple recipe posts
        
        Args:
            recipes: List of recipe dictionaries
            delay: Seconds to wait between posts (prevent rate limiting)
            
        Returns:
            List of created post data
        """
        import time
        
        results = []
        for i, recipe in enumerate(recipes, 1):
            try:
                print(f"Creating recipe {i}/{len(recipes)}: {recipe['title']}")
                result = self.create_recipe_post(recipe)
                results.append(result)
                print(f"✓ Created: {result['url']}")
                
                if i < len(recipes):
                    time.sleep(delay)
            except Exception as e:
                print(f"✗ Failed: {recipe['title']} - {e}")
                results.append({'error': str(e), 'title': recipe['title']})
        
        return results


# ============================================================================
# USAGE EXAMPLES
# ============================================================================

def example_single_recipe():
    """Example: Create a single recipe post"""
    
    # Initialize generator
    generator = RecipePostGenerator(
        wp_url='http://food1.local',
        username='admin',
        app_password='your-app-password-here'  # Get from WordPress Users → Profile
    )
    
    # Recipe data
    recipe = {
        'title': 'Butter-Poached Lobster',
        'intro': 'Discover the luxurious taste of butter-poached lobster. This recipe creates tender, succulent lobster meat infused with rich butter and delicate garlic flavors.',
        'ingredients': [
            '4 lobster tails',
            '1 cup unsalted butter, cut into cubes',
            '1/4 cup water',
            '2 cloves garlic, minced (optional)',
            '1 tablespoon lemon juice',
            'Salt and pepper, to taste',
            'Fresh parsley, chopped (for garnish)',
            'Lemon wedges (for serving)'
        ],
        'directions': [
            'Prepare the Butter Sauce: In a medium saucepan, heat 1/4 cup water over medium-low heat until it just begins to simmer.',
            'Emulsify the Butter: Slowly add the butter cubes, one at a time, whisking constantly to create a smooth, emulsified butter sauce.',
            'Flavor the Sauce: Once all the butter is melted and smooth, stir in the minced garlic, lemon juice, and a pinch of salt and pepper.',
            'Poach the Lobster: Reduce the heat to low, keeping the butter sauce warm but not boiling. Carefully place the lobster tails in the butter sauce.',
            'Serve: Remove the lobster tails from the butter and serve immediately. Garnish with fresh parsley and a drizzle of the butter sauce.'
        ],
        'tips': [
            'For best results, keep the sauce at a low temperature to avoid separation.',
            'Serve with crusty bread or over a bed of pasta to make it a complete meal.',
            'This method also works well for poaching shrimp or scallops.'
        ],
        'prep_time': '10 minutes',
        'cook_time': '10 minutes',
        'total_time': '20 minutes',
        'calories': '~400 kcal',
        'servings': '4',
        'tags': ['seafood', 'lobster', 'butter', 'gourmet', 'main-course']
    }
    
    # Create post
    result = generator.create_recipe_post(recipe)
    
    print(f"Recipe created successfully!")
    print(f"URL: {result['url']}")
    print(f"ID: {result['id']}")


def example_bulk_recipes():
    """Example: Create multiple recipes from JSON file"""
    
    generator = RecipePostGenerator(
        wp_url='http://food1.local',
        username='admin',
        app_password='your-app-password-here'
    )
    
    # Load recipes from JSON file
    with open('recipes.json', 'r') as f:
        recipes = json.load(f)
    
    # Create all recipes
    results = generator.bulk_create_recipes(recipes)
    
    # Print summary
    successful = sum(1 for r in results if 'url' in r)
    print(f"\nSummary: {successful}/{len(recipes)} recipes created successfully")


def example_with_chatgpt():
    """Example: Generate recipe with ChatGPT and post to WordPress"""
    
    import openai
    
    # Generate recipe with ChatGPT
    openai.api_key = 'your-openai-api-key'
    
    prompt = """
    Generate a JSON recipe for Chocolate Chip Cookies with this structure:
    {
        "title": "Recipe Title",
        "intro": "2-3 sentence introduction",
        "ingredients": ["ingredient 1", "ingredient 2"],
        "directions": ["step 1", "step 2"],
        "tips": ["tip 1", "tip 2"],
        "prep_time": "X minutes",
        "cook_time": "X minutes",
        "total_time": "X minutes",
        "calories": "X kcal",
        "servings": "X",
        "tags": ["tag1", "tag2"]
    }
    """
    
    response = openai.ChatCompletion.create(
        model="gpt-4",
        messages=[{"role": "user", "content": prompt}]
    )
    
    recipe = json.loads(response.choices[0].message.content)
    
    # Post to WordPress
    generator = RecipePostGenerator(
        wp_url='http://food1.local',
        username='admin',
        app_password='your-app-password-here'
    )
    
    result = generator.create_recipe_post(recipe)
    print(f"AI-generated recipe posted: {result['url']}")


if __name__ == '__main__':
    print("Recipe Post Generator - Ready to use")
    print("\nUncomment one of the example functions below to test:\n")
    
    # Uncomment to run:
    # example_single_recipe()
    # example_bulk_recipes()
    # example_with_chatgpt()
