<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['nama', 'alamat', 'nomor_hp', 'email'])]
class Donatur extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'donatur';

    /**
     * Get the donasi for the donatur
     */
    public function donasi(): HasMany
    {
        return $this->hasMany(Donasi::class);
    }

    /**
     * Get total donasi amount
     */
    public function getTotalDonasi(): int|float
    {
        return $this->donasi()
            ->where('jenis_donasi', 'uang')
            ->sum('jumlah_donasi');
    }
}
