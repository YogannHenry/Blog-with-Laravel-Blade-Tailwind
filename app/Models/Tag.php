<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function tagArticle()
    { // association N/N avec table article_tag
        return $this->belongsToMany(Article::class, 'article_tag', 'tag_id', 'article_id');
    }


}
