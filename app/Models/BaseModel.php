<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class BaseModel extends Model
{
    use SoftDeletes;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // Scopes

    public function scopeRecent (Builder $query) {
        return $query->orderBy('created_at', 'desc')->limit(10);
    }

    public function scopeModified( Builder $query) {
        return $query->orderBy('updated_at', 'desc');
    }
}
