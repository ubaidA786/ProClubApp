<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address_1',
        'address_2',
        'city',
        'state',
        'zip',
        'website',
        'access_start_date',
        'access_end_date',
        'ip_addresses',
        'passcode',
        'media_id',
        'description',
        'status',
    ];

    public function mediajoin()
    {
        return $this->belongsTo('App\Models\Media', 'media_id');
    }

    public function scopeOrderByName($query)
    {
        $query->orderBy('name');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->orderBy('created_at', 'desc');
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }
}
