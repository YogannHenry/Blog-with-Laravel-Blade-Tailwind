<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{

    use HasFactory;

    protected $fillable = ['name'];

    public function categoryArticle()
    { // association N/N avec table article_tag
        return $this->belongsToMany(Article::class, 'article_categories', 'category_id', 'article_id');
    }
}
