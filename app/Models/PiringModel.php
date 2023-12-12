<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PiringModel extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = "piring_catalogue";
    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_piring'
            ]
        ];
    }
}
