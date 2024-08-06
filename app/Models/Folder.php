<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function scopeName($query, $name)
    {
        if (!is_null($name))
            return $query->where('name', 'LIKE', '%' . $name . '%');
    }

    public function scopeDate($query, $start, $end)
    {
        if (!is_null($start) && !is_null($end))
            return $query->whereBetween('date', [$start, $end]);
        elseif (!is_null($start) && is_null($end))
            return $query->whereDate('date', '>=', $start);
        elseif (is_null($start) && !is_null($end))
            return $query->whereDate('date', '<=', $end);
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function company(): HasOneThrough
    {
        return $this->hasOneThrough(Company::class, Project::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
