<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['donatur_id', 'user_id', 'jenis_donasi', 'jumlah_donasi', 'jumlah_barang', 'tanggal_donasi', 'metode_penyaluran', 'bukti_transfer', 'keterangan'])]
class Donasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'donasi';

    protected $casts = [
        'tanggal_donasi' => 'date',
    ];

    /**
     * Get the donatur that owns the donasi
     */
    public function donatur(): BelongsTo
    {
        return $this->belongsTo(Donatur::class);
    }
}
