<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ibadah;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with statistics.
     */
    public function index()
    {
        // Total anggota
        $totalAnggota = User::count();
        
        // Kegiatan mendatang (ibadah dalam 30 hari ke depan)
        $kegiatanMendatang = Ibadah::where('tanggal', '>=', Carbon::now())
            ->where('tanggal', '<=', Carbon::now()->addDays(30))
            ->count();
        
        // Ulang tahun bulan ini
        $ulangTahunBulanIni = User::whereNotNull('tanggal_lahir')
            ->whereMonth('tanggal_lahir', Carbon::now()->month)
            ->count();
        
        // Anggota yang berulang tahun minggu ini
        $ulangTahunMingguIni = User::whereNotNull('tanggal_lahir')
            ->get()
            ->filter(function($user) {
                $birthday = Carbon::parse($user->tanggal_lahir)->setYear((int)date('Y'));
                return $birthday->isCurrentWeek();
            });
        
        return view('dashboard', compact(
            'totalAnggota',
            'kegiatanMendatang', 
            'ulangTahunBulanIni',
            'ulangTahunMingguIni'
        ));
    }
}
