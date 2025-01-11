<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

        protected $fillable = [
        'title', 'news_content', 'author_id', 'image'
    ];

      public function writer(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'author_id', 'id');
    }

    /**
     * Get all of the comments for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
