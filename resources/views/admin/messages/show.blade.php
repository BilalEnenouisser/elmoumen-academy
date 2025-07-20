@extends('layouts.admin')

@section('title', 'Détails du Message')

@section('content')
<div class="space-y-4">
    <div class="border-b pb-4">
        <h2 class="text-lg font-medium">{{ $message->subject }}</h2>
        <p class="text-sm text-gray-500">Reçu le {{ $message->created_at->format('d/m/Y à H:i') }}</p>
    </div>

    <div>
        <h3 class="text-sm font-medium text-gray-500">De:</h3>
        <p>{{ $message->name }} &lt;{{ $message->email }}&gt;</p>
    </div>

    <div>
        <h3 class="text-sm font-medium text-gray-500">Message:</h3>
        <div class="mt-2 p-4 bg-gray-50 rounded-lg">
            {{ $message->message }}
        </div>
    </div>

    <div class="pt-4">
        <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-transparent rounded-md hover:bg-gray-200">
            Retour
        </a>
    </div>
</div>
@endsection