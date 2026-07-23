<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $categories = Category::query()->pluck('id', 'slug')->all();

        $catalog = [
            'burger' => [
                'Classic Beef Burger',
                'Cheese Melt Burger',
                'Spicy Chicken Burger',
                'BBQ Bacon Burger',
                'Mushroom Swiss Burger',
                'Double Smash Burger',
                'Crispy Fish Burger',
            ],
            'pizza' => [
                'Margherita Pizza',
                'Pepperoni Feast Pizza',
                'BBQ Chicken Pizza',
                'Seafood Supreme Pizza',
                'Veggie Lovers Pizza',
                'Hawaiian Delight Pizza',
                'Four Cheese Pizza',
            ],
            'dessert' => [
                'Chocolate Lava Cake',
                'Classic Tiramisu',
                'New York Cheesecake',
                'Red Velvet Slice',
                'Caramel Pudding',
                'Banana Split Sundae',
                'Molten Brownie',
            ],
            'drinks' => [
                'Fresh Orange Juice',
                'Iced Lemon Tea',
                'Mango Smoothie',
                'Sparkling Soda',
                'Coconut Water',
                'Strawberry Milkshake',
                'Herbal Detox Drink',
            ],
            'seafood' => [
                'Grilled Salmon Steak',
                'Garlic Butter Shrimp',
                'Crispy Calamari Rings',
                'Seafood Platter',
                'Tuna Poke Bowl',
                'Butter Lobster Roll',
                'Spicy Crab Rice',
            ],
            'pasta' => [
                'Spaghetti Bolognese',
                'Creamy Carbonara',
                'Penne Arrabbiata',
                'Chicken Alfredo Pasta',
                'Seafood Linguine',
                'Mushroom Pesto Pasta',
                'Baked Mac and Cheese',
            ],
            'chicken' => [
                'Fried Chicken Bucket',
                'Spicy Grilled Chicken',
                'Honey Garlic Wings',
                'Chicken Karaage',
                'Roasted Chicken Quarter',
                'Crispy Chicken Tenders',
                'Chicken Parmigiana',
            ],
            'coffee' => [
                'Espresso Shot',
                'Cappuccino',
                'Caramel Latte',
                'Iced Americano',
                'Mocha Frappuccino',
                'Vanilla Cold Brew',
                'Hazelnut Macchiato',
            ],
            'salad' => [
                'Caesar Salad',
                'Greek Salad',
                'Quinoa Bowl Salad',
                'Avocado Chicken Salad',
                'Garden Fresh Salad',
                'Prawn Mango Salad',
                'Kale Superfood Salad',
            ],
            'asian-food' => [
                'Chicken Teriyaki Bowl',
                'Beef Bulgogi Rice',
                'Pad Thai Noodles',
                'Sushi Combo Platter',
                'Nasi Goreng Special',
                'Ramen Tonkotsu',
                'Thai Green Curry',
            ],
            'healthy-food' => [
                'Grilled Salmon Salad',
                'Quinoa Power Bowl',
                'Avocado Toast',
                'Steamed Chicken Breast',
                'Veggie Wrap',
                'Tofu Buddha Bowl',
                'Overnight Oats',
            ],
            'breakfast' => [
                'Buttermilk Pancakes',
                'Eggs Benedict',
                'Sausage Breakfast Plate',
                'French Toast',
                'Omelette Supreme',
                'Breakfast Burrito',
                'Granola Yogurt Bowl',
            ],
            'bbq' => [
                'Smoked Beef Brisket',
                'BBQ Pork Ribs',
                'Grilled Lamb Chops',
                'Charcoal Chicken Skewer',
                'Honey BBQ Wings',
                'Sizzling BBQ Platter',
                'Smoked Sausage Feast',
            ],
            'noodles' => [
                'Chicken Chow Mein',
                'Beef Udon',
                'Seafood Ramen',
                'Spicy Mie Goreng',
                'Pad See Ew',
                'Laksa Noodles',
                'Veggie Yakisoba',
            ],
            'ice-cream' => [
                'Vanilla Bean Scoop',
                'Chocolate Fudge Scoop',
                'Strawberry Sundae',
                'Cookies and Cream Gelato',
                'Salted Caramel Swirl',
                'Mango Sorbet',
                'Matcha Ice Cream',
            ],
        ];

        foreach ($catalog as $slug => $items) {
            if (! isset($categories[$slug])) {
                continue;
            }

            foreach ($items as $index => $name) {
                $productSlug = Str::slug($name);

                Product::query()->updateOrCreate(
                    ['slug' => $productSlug],
                    [
                        'category_id' => $categories[$slug],
                        'name' => $name,
                        'description' => fake()->paragraphs(2, true),
                        'price' => fake()->randomFloat(2, 5, 120),
                        'stock' => fake()->numberBetween(10, 250),
                        'weight' => fake()->randomFloat(2, 0.1, 3),
                        'thumbnail' => 'products/' . $productSlug . '.jpg',
                        'featured' => $index < 2,
                        'popular' => $index < 3,
                        'status' => 'published',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ],
                );
            }
        }
    }
}
