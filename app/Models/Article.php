<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'description',
        'imageUrl',

    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function chirp(): HasMany
    {
        return $this->hasMany(Chirp::class);
    }



    public function articleTag()
    { // association N/N avec table article_tag
        return $this->belongsToMany(Tag::class, 'article_tag', 'article_id', 'tag_id');
    }




    public function articleCategory()
    {
        return $this->belongsToMany(Category::class, 'article_categories', 'article_id', 'category_id');
    }
    // Le deuxième argument passé à la méthode belongsToMany
    // est le nom de la table pivot qui va relier les articles
    //  aux catégories. Dans cet exemple, la table pivot s'appelle
    //  article_category.
}
