<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dokumentasi extends Model
{
    protected $table = 'dokumentasi';

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal_kegiatan',
        'lokasi',
        'foto_kegiatan',
        'kategori',
        'created_by',
        'is_published'
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
        'foto_kegiatan' => 'array',
        'is_published' => 'boolean'
    ];

    /**
     * Relationship dengan User (pembuat dokumentasi)
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope untuk dokumentasi yang dipublikasi
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope untuk filter berdasarkan kategori
     */
    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Accessor untuk mendapatkan foto pertama
     */
    public function getFotoUtamaAttribute()
    {
        $fotos = $this->foto_kegiatan;
        return is_array($fotos) && count($fotos) > 0 ? $fotos[0] : null;
    }

    /**
     * Accessor untuk format tanggal Indonesia
     */
    public function getTanggalKegiatanFormattedAttribute()
    {
        return $this->tanggal_kegiatan->format('d F Y');
    }
}
