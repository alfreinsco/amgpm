<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('whatsapp', 'like', "%{$search}%")
                  ->orWhere('tempat_lahir', 'like', "%{$search}%");
            });
        }

        // Filter by golongan darah
        if ($request->filled('golongan_darah')) {
            $query->where('golongan_darah', $request->golongan_darah);
        }

        // Filter by admin status
        if ($request->filled('is_admin')) {
            $query->where('is_admin', $request->is_admin === '1');
        }

        $anggota = $query->orderBy('nama')->paginate(10)->withQueryString();

        return view('anggota.index', compact('anggota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'golongan_darah' => 'required|in:A,B,AB,O',
            'whatsapp' => 'required|string|unique:users,whatsapp',
            'is_admin' => 'boolean'
        ]);

        // Format the phone number
        $validated['whatsapp'] = formatPhoneNumber($validated['whatsapp']);

        // Generate password from birth date (YYYYMMDD format)
        $birthDate = Carbon::parse($validated['tanggal_lahir']);
        $defaultPassword = $birthDate->format('Ymd');
        $validated['password'] = Hash::make($defaultPassword);

        $validated['is_admin'] = $request->has('is_admin');

        $anggotum = User::create($validated);

        return redirect()->route('anggota.show', $anggotum->id)
                        ->with('success', 'Data anggota berhasil ditambahkan. Password default: ' . $defaultPassword);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $anggotum)
    {
        return view('anggota.show', compact('anggotum'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $anggotum)
    {
        return view('anggota.edit', compact('anggotum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $anggotum)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($anggotum->id)],
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'golongan_darah' => 'required|in:A,B,AB,O',
            'whatsapp' => ['required', 'string', Rule::unique('users')->ignore($anggotum->id)],
            'is_admin' => 'boolean'
        ]);

        // Format the phone number
        $validated['whatsapp'] = formatPhoneNumber($validated['whatsapp']);

        $validated['is_admin'] = $request->has('is_admin');

        $anggotum->update($validated);

        return redirect()->route('anggota.show', $anggotum->id)
                        ->with('success', 'Data anggota berhasil diperbarui.');
    }

    /**
     * Reset password to default format (birth date)
     */
    public function resetPassword(User $anggotum)
    {
        if (!$anggotum->tanggal_lahir) {
            return redirect()->back()
                            ->with('error', 'Tidak dapat mereset password. Tanggal lahir tidak tersedia.');
        }

        // Generate password from birth date (YYYYMMDD format)
        $birthDate = Carbon::parse($anggotum->tanggal_lahir);
        $defaultPassword = $birthDate->format('Ymd');

        $anggotum->update([
            'password' => Hash::make($defaultPassword)
        ]);

        return redirect()->back()
                        ->with('success', 'Password berhasil direset ke format default: ' . $defaultPassword);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $anggotum)
    {
        $anggotum->delete();

        return redirect()->route('anggota.index')
                        ->with('success', 'Data anggota berhasil dihapus.');
    }
}
