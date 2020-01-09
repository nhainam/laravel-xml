<?php
/**
 * Created by: PhpStorm.
 * UserCreated: Nam Nguyen
 * DateCreated: 10/12/19 20:11
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    /**
     * @var string
     */
    protected $table = "channels";

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'category_id',
        'user_id',
        'description',
        'link',
        'last_build_date',
        'published_date',
        'category_domain',
        'copyright',
        'docs',
        'language',
        'managing_editor',
        'web_master',
        'generator'
    ];
}
