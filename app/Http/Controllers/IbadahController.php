<?php

namespace App\Http\Controllers;

use App\Models\Ibadah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IbadahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Ibadah::with('user');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('lokasi', 'like', '%' . $search . '%')
                  ->orWhere('pemimpin', 'like', '%' . $search . '%')
                  ->orWhere('pemandu', 'like', '%' . $search . '%')
                  ->orWhere('catatan', 'like', '%' . $search . '%');
            });
        }

        // Date range filter
        if ($request->filled('start_date')) {
            $query->where('tanggal', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->where('tanggal', '<=', $request->end_date);
        }

        $ibadah = $query->orderBy('tanggal', 'desc')
                       ->orderBy('waktu', 'desc')
                       ->paginate(10)
                       ->appends($request->query());

        return view('ibadah.index', compact('ibadah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ibadah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'lokasi' => 'required|string|max:255',
            'pemimpin' => 'required|string|max:255',
            'pemandu' => 'nullable|string|max:255',
            'catatan' => 'nullable|string|max:500'
        ]);

        $validated['user_id'] = Auth::id();

        $ibadah = Ibadah::create($validated);

        return redirect()->route('ibadah.show', $ibadah->id)
                        ->with('success', 'Jadwal ibadah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ibadah $ibadah)
    {
        $ibadah->load('user');
        return view('ibadah.show', compact('ibadah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ibadah $ibadah)
    {
        return view('ibadah.edit', compact('ibadah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ibadah $ibadah)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'lokasi' => 'required|string|max:255',
            'pemimpin' => 'required|string|max:255',
            'pemandu' => 'nullable|string|max:255',
            'catatan' => 'nullable|string|max:500'
        ]);

        $ibadah->update($validated);

        return redirect()->route('ibadah.show', $ibadah->id)
                        ->with('success', 'Jadwal ibadah berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ibadah $ibadah)
    {
        $ibadah->delete();

        return redirect()->route('ibadah.index')
                        ->with('success', 'Jadwal ibadah berhasil dihapus!');
    }
}
