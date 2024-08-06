<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function scopeName($query, $name)
    {
        if (!is_null($name))
            return $query->where('name', 'LIKE', '%' . $name . '%');
    }

    public function documents(): BelongsToMany
    {
        return $this->belongsToMany(Document::class, 'document_tag');
    }
}
