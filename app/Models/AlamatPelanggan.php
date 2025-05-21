<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlamatPelanggan extends Model
{
    use HasFactory;

    protected $table = 'alamat_pelanggan';

    protected $fillable = [
        'pelanggan_id',
        'jalan',
        'kota',
        'provinsi',
        'kode_pos',
    ];

    /**
     * Get the pelanggan that owns this alamat.
     */
    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
