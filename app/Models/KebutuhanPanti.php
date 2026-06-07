<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['nama_kebutuhan', 'jumlah_kebutuhan', 'tanggal_pengajuan', 'status', 'keterangan'])]
class KebutuhanPanti extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kebutuhan_panti';

    protected $casts = [
        'tanggal_pengajuan' => 'date',
    ];

    /**
     * Check if kebutuhan is terpenuhi
     */
    public function isTerpenuhi(): bool
    {
        return $this->status === 'terpenuhi';
    }

    /**
     * Check if kebutuhan is belum_terpenuhi
     */
    public function isBelumTerpenuhi(): bool
    {
        return $this->status === 'belum_terpenuhi';
    }
}
