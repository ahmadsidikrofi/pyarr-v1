<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanModel extends Model
{
    use HasFactory;
    protected $table = 'peminjaman_piring';
    protected $guarded = ["actual_return_date"];

    public function piring_catalogue()
    {
        return $this->belongsTo(PiringModel::class, 'piring_catalogue_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
