<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::latest()->paginate(10);
        return view('admin.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'required|url',
            'video_url' => 'required|url',
            'category' => 'required|in:mothers,parents,students',
        ]);

        Video::create($request->all());

        return redirect()->route('admin.videos.index')
            ->with('success', 'Vidéo ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'required|url',
            'video_url' => 'required|url',
            'category' => 'required|in:mothers,parents,students',
        ]);

        $video->update($request->all());

        return redirect()->route('admin.videos.index')
            ->with('success', 'Vidéo mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('admin.videos.index')
            ->with('success', 'Vidéo supprimée.');
    }
}
