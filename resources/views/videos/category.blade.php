@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-[#0F2239] mb-4">{{ $category->name }}</h1>
        @if($category->description)
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">{{ $category->description }}</p>
        @endif
    </div>

    @if($videos->isEmpty())
        <div class="text-center py-12">
            <div class="text-gray-500 text-lg">Aucune vidéo disponible pour cette catégorie.</div>
        </div>
    @else
        <!-- 3x3 Grid of Videos -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($videos as $video)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <!-- Video Thumbnail -->
                <div class="relative">
                    <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" class="w-full h-48 object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center">
                        <div class="bg-white bg-opacity-90 rounded-full p-3">
                            <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                <polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Video Info -->
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-[#0F2239] mb-2 line-clamp-2">{{ $video->title }}</h3>
                    @if($video->description)
                        <p class="text-gray-600 text-sm mb-3 line-clamp-3">{{ $video->description }}</p>
                    @endif
                    
                    <!-- Play Button -->
                    <a href="{{ $video->video_link }}" target="_blank" 
                       class="inline-flex items-center justify-center w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition-colors duration-200"
                       onclick="trackVideoClick({{ $video->id }})">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/>
                        </svg>
                        Regarder la vidéo
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($videos->hasPages())
            <div class="flex justify-center">
                {{ $videos->links() }}
            </div>
        @endif
    @endif
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<script>
function trackVideoClick(videoId) {
    fetch(`/track/video-click/${videoId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });
}
</script>
@endsection 