<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Dokumentasi::with('creator');
        
        // Admin dapat melihat semua dokumentasi, user biasa hanya yang published
        if (!Auth::user()->is_admin) {
            $query->published();
        } else {
            // Filter berdasarkan status publikasi (khusus admin)
            if ($request->filled('status')) {
                if ($request->status === 'published') {
                    $query->published();
                } elseif ($request->status === 'draft') {
                    $query->where('is_published', false);
                }
                // Jika 'all' atau kosong, tampilkan semua (tidak perlu filter tambahan)
            }
        }

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->byKategori($request->kategori);
        }

        // Search berdasarkan judul
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $dokumentasi = $query->orderBy('tanggal_kegiatan', 'desc')->paginate(12);
        $kategoris = ['umum', 'ibadah', 'sosial', 'pendidikan', 'kesehatan'];

        return view('dokumentasi.index', compact('dokumentasi', 'kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = ['umum', 'ibadah', 'sosial', 'pendidikan', 'kesehatan'];
        return view('dokumentasi.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_kegiatan' => 'required|date',
            'lokasi' => 'nullable|string|max:255',
            'kategori' => 'required|string|in:umum,ibadah,sosial,pendidikan,kesehatan',
            'foto_kegiatan.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'is_published' => 'boolean'
        ]);

        $validated['created_by'] = Auth::id();
        $validated['is_published'] = $request->has('is_published');

        // Handle multiple photo uploads
        if ($request->hasFile('foto_kegiatan')) {
            $fotoPaths = [];
            foreach ($request->file('foto_kegiatan') as $foto) {
                $filename = time() . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
                $path = $foto->storeAs('dokumentasi_photos', $filename, 'public');
                $fotoPaths[] = $path;
            }
            $validated['foto_kegiatan'] = $fotoPaths;
        }

        Dokumentasi::create($validated);

        return redirect()->route('dokumentasi.index')
            ->with('success', 'Dokumentasi kegiatan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dokumentasi $dokumentasi)
    {
        $dokumentasi->load('creator');
        return view('dokumentasi.show', compact('dokumentasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dokumentasi $dokumentasi)
    {
        $kategoris = ['umum', 'ibadah', 'sosial', 'pendidikan', 'kesehatan'];
        return view('dokumentasi.edit', compact('dokumentasi', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dokumentasi $dokumentasi)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_kegiatan' => 'required|date',
            'lokasi' => 'nullable|string|max:255',
            'kategori' => 'required|string|in:umum,ibadah,sosial,pendidikan,kesehatan',
            'foto_kegiatan.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean'
        ]);

        $validated['is_published'] = $request->has('is_published');

        // Handle new photo uploads
        if ($request->hasFile('foto_kegiatan')) {
            // Delete old photos
            if ($dokumentasi->foto_kegiatan) {
                foreach ($dokumentasi->foto_kegiatan as $oldPhoto) {
                    Storage::disk('public')->delete($oldPhoto);
                }
            }

            $fotoPaths = [];
            foreach ($request->file('foto_kegiatan') as $foto) {
                $filename = time() . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
                $path = $foto->storeAs('dokumentasi_photos', $filename, 'public');
                $fotoPaths[] = $path;
            }
            $validated['foto_kegiatan'] = $fotoPaths;
        }

        $dokumentasi->update($validated);

        return redirect()->route('dokumentasi.show', $dokumentasi)
            ->with('success', 'Dokumentasi kegiatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dokumentasi $dokumentasi)
    {
        // Delete photos from storage
        if ($dokumentasi->foto_kegiatan) {
            foreach ($dokumentasi->foto_kegiatan as $photo) {
                Storage::disk('public')->delete($photo);
            }
        }

        $dokumentasi->delete();

        return redirect()->route('dokumentasi.index')
            ->with('success', 'Dokumentasi kegiatan berhasil dihapus.');
    }

    /**
     * Remove specific photo from documentation
     */
    public function removePhoto(Request $request, Dokumentasi $dokumentasi)
    {
        $photoIndex = $request->input('photo_index');
        $fotos = $dokumentasi->foto_kegiatan;

        if (isset($fotos[$photoIndex])) {
            // Delete photo from storage
            Storage::disk('public')->delete($fotos[$photoIndex]);

            // Remove from array
            unset($fotos[$photoIndex]);
            $fotos = array_values($fotos); // Reindex array

            $dokumentasi->update(['foto_kegiatan' => $fotos]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }
}
