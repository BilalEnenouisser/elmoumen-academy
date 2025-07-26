<?php

namespace App\Http\Controllers;

use App\Models\VideoCategory;
use App\Models\CategoryVideo;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function category($slug)
    {
        $category = VideoCategory::where('slug', $slug)->firstOrFail();
        $videos = $category->activeVideos()->paginate(9); // 3x3 grid

        return view('videos.category', compact('category', 'videos'));
    }

    public function show(CategoryVideo $video)
    {
        return view('videos.show', compact('video'));
    }
} 