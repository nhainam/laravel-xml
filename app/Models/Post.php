<?php
/**
 * Created by: PhpStorm.
 * UserCreated: Nam Nguyen
 * DateCreated: 10/12/19 20:11
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * @var string
     */
    protected $table = "posts";

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'category_id',
        'channel_id',
        'user_id',
        'description',
        'comments',
        'published_date',
        'link',
        'guid',
        'is_permalink'
    ];
}
