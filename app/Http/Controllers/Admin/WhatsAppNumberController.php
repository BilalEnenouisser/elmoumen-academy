<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhatsAppNumber;
use Illuminate\Http\Request;

class WhatsAppNumberController extends Controller
{
    public function index()
    {
        $whatsappNumber = WhatsAppNumber::first();
        return view('admin.whatsapp.index', compact('whatsappNumber'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string|max:20'
        ]);

        // Delete existing number if any
        WhatsAppNumber::truncate();

        // Create new number
        WhatsAppNumber::create([
            'phone_number' => $request->phone_number,
            'is_active' => true
        ]);

        return redirect()->route('admin.whatsapp.index')
            ->with('success', 'Numéro WhatsApp mis à jour avec succès.');
    }

    public function update(Request $request, WhatsAppNumber $whatsappNumber)
    {
        $request->validate([
            'phone_number' => 'required|string|max:20'
        ]);

        $whatsappNumber->update([
            'phone_number' => $request->phone_number
        ]);

        return redirect()->route('admin.whatsapp.index')
            ->with('success', 'Numéro WhatsApp mis à jour avec succès.');
    }
}
