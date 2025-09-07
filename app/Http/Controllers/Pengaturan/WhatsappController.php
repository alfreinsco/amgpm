<?php

namespace App\Http\Controllers\Pengaturan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WhatsappController extends Controller
{
    public function index(Request $request){
        return view('pengaturan.whatsapp.index', compact('request'));
    }
}
