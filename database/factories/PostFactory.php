<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $catId = Category::all()->pluck('id')->toArray();
        $tagId = Tag::all()->pluck('id')->toArray();
        $userId = User::all()->pluck('id')->toArray();
        $width = 277;
        $height = 319;
        return [
            'title' => $this->faker->sentence(6),
            'description' => $this->faker->paragraph(5),
            'image' => $this->faker->imageUrl("https://loremflickr.com/g/{$width}/{$height}/paris"),
            'category_id' => $this->faker->randomElement($catId),
            'tag_id' => $this->faker->randomElement($tagId),
            'sticky' => 'off',
            'user_id' => $this->faker->randomElement($userId),
            'slug' => strtolower(str_replace(" ","-",$this->faker->sentence(6))),
        ];
    }
}
