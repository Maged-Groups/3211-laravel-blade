<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Post extends BaseModel
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;


    protected $fillable = [
        "post_title",
        "post_body",
        "thumbnail",
        "user_id",
        "post_status_id",
    ];

    // Scopes
    public function scopeActive(Builder $query)
    {
        return $query->whereIn('post_status_id', [1, 2, 7]);
    }

    public function scopeInactive(Builder $query)
    {
        return $query->whereIn('post_status_id', [3, 4, 5, 6]);
    }

    // Relationships
    public function reactions(): MorphMany
    {
        return $this->morphMany(Reaction::class, 'reactable');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function user(): BelongsTo
    {
        // return $this->belongsTo(User::class, 'user_id', 'id');
        return $this->belongsTo(User::class);
    }

    public function postStatus(): BelongsTo
    {
        return $this->belongsTo(PostStatus::class);
    }
}
