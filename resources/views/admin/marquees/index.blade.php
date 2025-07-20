@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Bande Annonce (Marquee)</h1>

    @if(session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.marquees.store') }}" class="mb-6 space-y-4">
        @csrf
        <input type="text" name="text" placeholder="Texte du message" class="w-full p-2 border rounded" required>
        <input type="text" name="author" placeholder="Auteur (optionnel)" class="w-full p-2 border rounded">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Ajouter</button>
    </form>

    <h2 class="text-lg font-semibold mb-2">Messages existants :</h2>
    <ul>
        @foreach($marquees as $item)
            <li class="mb-2 border-b pb-2 flex justify-between items-center">
                <div>
                    🔔 <strong>{{ $item->text }}</strong>
                    @if($item->author)
                        <span class="text-gray-500 ml-2">({{ $item->author }})</span>
                    @endif
                </div>
                <form method="POST" action="{{ route('admin.marquees.destroy', $item) }}">
                    @csrf @method('DELETE')
                    <button class="text-red-600">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
