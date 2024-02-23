<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class CategoryModel extends Model
{
    use Sluggable;
    use HasFactory;
    protected $table = "category";
    protected $guarded = [];
    // protected $fillable = ['jenis_bahan'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'jenis_bahan'
            ]
        ];
    }
}
