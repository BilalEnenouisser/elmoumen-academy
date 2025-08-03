<?php

namespace App\Http\Controllers\Admin;

use App\Models\Marquee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class MarqueeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marquees = Marquee::latest()->get();
        return view('admin.marquees.index', compact('marquees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
        ]);

        Marquee::create($request->only('text', 'author'));

        return back()->with('success', 'Message ajouté.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Marquee $marquee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marquee $marquee)
    {
        return view('admin.marquees.edit', compact('marquee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marquee $marquee)
    {
        $request->validate([
            'text' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
        ]);

        $marquee->update($request->only('text', 'author'));

        return redirect()->route('admin.marquees.index')->with('success', 'Message mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marquee $marquee)
    {
        $marquee->delete();
        return back()->with('success', 'Message supprimé.');
    }
}
