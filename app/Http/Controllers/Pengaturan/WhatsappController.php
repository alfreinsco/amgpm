<?php

namespace App\Http\Controllers\Pengaturan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class WhatsappController extends Controller
{
    public function index(Request $request){
        return view('pengaturan.whatsapp.index', compact('request'));
    }

    public function getContacts(Request $request)
    {
        $query = $request->get('q', '');
        
        $contacts = User::whereNotNull('whatsapp')
                       ->where('whatsapp', '!=', '')
                       ->when($query, function($q) use ($query) {
                           $q->where(function($subQuery) use ($query) {
                               $subQuery->where('nama', 'LIKE', '%' . $query . '%')
                                       ->orWhere('whatsapp', 'LIKE', '%' . $query . '%');
                           });
                       })
                       ->select('id', 'nama', 'whatsapp')
                       ->orderBy('nama')
                       ->limit(20)
                       ->get();

        // Format for Select2
        $results = $contacts->map(function($contact) {
            return [
                'id' => $contact->whatsapp,
                'text' => $contact->nama . ' (' . $contact->whatsapp . ')'
            ];
        });

        return response()->json([
            'results' => $results,
            'pagination' => [
                'more' => false
            ]
        ]);
    }
}
