<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('bn_BD'); // Bangla locale if you want Bangla text

        for ($i = 1; $i <= 500; $i++) {
            $post = Post::create([
                'user_id' => 1,
                'publisher_name' => 'সুপার এডমিন',
                'featured_image' => 'https://beta.bangladeshsomoy.com/uploads/inter-20250707201630.jpg',
                'featured_mini' => 'https://beta.bangladeshsomoy.com/uploads/inter-20250707201630.jpg',
    
                // faker instead of static
                'headline' => $faker->sentence(rand(10, 15)),  
                'slug' => Str::slug($faker->unique()->sentence(rand(10, 15)) . '-' . $i),
                'excerpt' => $faker->text(100),
                'post_content' => $faker->paragraphs(rand(3, 6), true),
    
                'sticky' => 0,
                'post_status' => 1,
                'uniqid' => uniqid('post_'),
            ]);
    
            // pivot relations
            $post->categories()->attach([1]);   // single category
            $post->subCategory()->attach([21]); // single subcategory
        }

    }
}
