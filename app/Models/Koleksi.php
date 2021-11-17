<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koleksi extends Model
{
    use HasFactory;
    protected $table = 'koleksi';
    protected $primaryKey = 'id_koleksi';

    public function konten() {
        return $this->hasMany(Konten::class, 'id_koleksi');
    }
}
