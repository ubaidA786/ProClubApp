<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'url', 'description', 'status'];
    public function organization()
    {
        return $this->hasMany('App\Models\Organization');
    }
    public function scopeFilter($query, array $filters)
    {
        $query->orderBy('created_at', 'desc');
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        });
    }
}
