<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['nama', 'tanggal_lahir', 'jenis_kelamin', 'alamat', 'status'])]
class AnakPanti extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'anak_panti';

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Calculate age from tanggal_lahir
     */
    public function getUmur(): int
    {
        return $this->tanggal_lahir->age;
    }
}
