<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class ArticleCategory extends Model
{
    protected $table = 'article_categories';

    protected $primaryKey = ['article_id', 'category_id'];

    public $incrementing = false;

    protected $fillable = [
        'article_id',
        'category_id',
    ];

    public $timestamps = false;


}
