<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class ArticleTag extends Model
{
    protected $table = 'article_tags';

    protected $primaryKey = ['article_id', 'tag_id'];

    public $incrementing = false;

    protected $fillable = [
        'article_id',
        'tag_id',
    ];

    public $timestamps = false;

}
