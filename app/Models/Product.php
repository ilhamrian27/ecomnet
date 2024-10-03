<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Nama tabel di database, jika nama model tidak sesuai dengan plural dari nama model
    protected $table = 'products';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'sku',
        'name',
        'price',
        'reference',
    ];

    /**
     * Relasi ke tabel invoice.
     * Satu produk bisa memiliki banyak invoice.
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
