<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ibadah extends Model
{
    use HasFactory;

    protected $table = 'ibadah';

    protected $fillable = [
        'nama',
        'tanggal',
        'waktu',
        'lokasi',
        'pemimpin',
        'pemandu',
        'tema',
        'catatan',
        'user_id'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu' => 'datetime:H:i',
    ];

    /**
     * Relasi dengan User (pembuat jadwal)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor untuk format tanggal Indonesia
     */
    public function getTanggalFormattedAttribute()
    {
        return $this->tanggal ? Carbon::parse($this->tanggal)->format('d F Y') : null;
    }

    /**
     * Accessor untuk format waktu
     */
    public function getWaktuFormattedAttribute()
    {
        return $this->waktu ? Carbon::parse($this->waktu)->format('H:i') : null;
    }

    /**
     * Scope untuk jadwal yang akan datang
     */
    public function scopeUpcoming($query)
    {
        return $query->where('tanggal', '>=', now()->toDateString())
                    ->orderBy('tanggal', 'asc')
                    ->orderBy('waktu', 'asc');
    }

    /**
     * Scope untuk jadwal hari ini
     */
    public function scopeToday($query)
    {
        return $query->whereDate('tanggal', now()->toDateString());
    }
}
