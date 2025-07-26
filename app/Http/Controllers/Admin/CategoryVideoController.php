<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryVideo;
use App\Models\VideoCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryVideoController extends Controller
{
    public function index()
    {
        $videos = CategoryVideo::with('category')->latest()->paginate(20);
        return view('admin.category-videos.index', compact('videos'));
    }

    public function create()
    {
        $categories = VideoCategory::all();
        return view('admin.category-videos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_link' => 'required|url',
            'video_category_id' => 'required|exists:video_categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail_path'] = $request->file('thumbnail')->store('video-thumbnails', 'public');
        }

        CategoryVideo::create($data);

        return redirect()->route('admin.category-videos.index')->with('success', 'Video ajouté avec succès.');
    }

    public function edit(CategoryVideo $video)
    {
        $categories = VideoCategory::all();
        return view('admin.category-videos.edit', compact('video', 'categories'));
    }

    public function update(Request $request, CategoryVideo $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_link' => 'required|url',
            'video_category_id' => 'required|exists:video_categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($video->thumbnail_path) {
                Storage::disk('public')->delete($video->thumbnail_path);
            }
            $data['thumbnail_path'] = $request->file('thumbnail')->store('video-thumbnails', 'public');
        }

        $video->update($data);

        return redirect()->route('admin.category-videos.index')->with('success', 'Video mis à jour avec succès.');
    }

    public function destroy(CategoryVideo $video)
    {
        // Delete thumbnail
        if ($video->thumbnail_path) {
            Storage::disk('public')->delete($video->thumbnail_path);
        }

        $video->delete();

        return redirect()->route('admin.category-videos.index')->with('success', 'Video supprimé avec succès.');
    }
} 