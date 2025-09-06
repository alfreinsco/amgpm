<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UlangTahunController extends Controller
{
    /**
     * Display a listing of birthday schedules.
     */
    public function index(Request $request)
    {
        // Get current month as default
        $currentMonth = Carbon::now()->month;
        $selectedMonth = $request->get('bulan', $currentMonth);
        
        // Get users with birthdays in selected month
        $anggota = User::whereNotNull('tanggal_lahir')
            ->whereMonth('tanggal_lahir', $selectedMonth)
            ->orderByRaw('DAY(tanggal_lahir) ASC')
            ->get();
        
        // Get month names for dropdown
        $bulanList = [
            1 => 'Januari',
            2 => 'Februari', 
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
        
        return view('ulang-tahun.index', compact('anggota', 'selectedMonth', 'bulanList', 'currentMonth'));
    }
}
