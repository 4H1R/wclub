<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

/**
 * @mixin IdeHelperGame
 */
class Game extends Model
{
    use HasFactory, Sushi;

    public function getRows(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'نردبان شادی',
                'slug' => 'nardeban-shadi',
                'image' => asset('images/games/nardebanShadi.webp'),
                'image_type' => 'cover',
                'short_description' => 'بازی مار و پله با طعم نردبان شادی.',
            ],
            // [
            //     'id' => 2,
            //     'title' => 'تاس سی',
            //     'slug' => 'roll-the-dice',
            //     'image' => asset('images/games/rollTheDice.webp'),
            //     'image_type' => 'contain',
            //     'short_description' => 'با ربات باشگاه بانوان مسابقه تاس اندازی بده و هرکی عدد سی رو زودتر اورد برندست.',
            // ],
        ];
    }
}
