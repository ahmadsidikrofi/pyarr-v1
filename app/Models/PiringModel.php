<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PiringModel extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = "piring_catalogue";
    protected $guarded = [];

    // function categories()
    // {
    //     $this->belongsToMany(CategoryModel::class, "category_id", "piring_catalogue_id" , "piring_category");
    // }
    public function categories()
    {
        return $this->belongsToMany(CategoryModel::class, 'piring_category', 'piring_catalogue_id', 'category_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters["search"] ?? false, function ($query, $search) {
            return $query->where('nama_piring', 'like', '%' . $search . '%')
                ->orWhere('deskripsi_piring', 'like', '%' . $search . '%');
        });
        return $query;
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_piring',
            ],
        ];
    }
}
