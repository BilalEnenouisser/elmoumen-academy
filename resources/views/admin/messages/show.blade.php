@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Message Details</h1>
        
        <div class="space-y-4">
            <div>
                <h2 class="font-semibold">From:</h2>
                <p>{{ $message->name }} &lt;{{ $message->email }}&gt;</p>
            </div>
            
            <div>
                <h2 class="font-semibold">Subject:</h2>
                <p>{{ $message->subject }}</p>
            </div>
            
            <div>
                <h2 class="font-semibold">Date:</h2>
                <p>{{ $message->created_at->format('d/m/Y H:i') }}</p>
            </div>
            
            <div class="mt-6">
                <h2 class="font-semibold">Message:</h2>
                <div class="bg-gray-50 p-4 rounded mt-2">
                    {{ $message->message }}
                </div>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('admin.messages.index') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Back to Messages
            </a>
        </div>
    </div>
</div>
@endsection