@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Modifier un enseignant</h1>

<form action="{{ route('admin.teachers.update', $teacher) }}" method="POST" class="space-y-4 max-w-md">
    @csrf @method('PUT')
    <input type="text" name="name" value="{{ $teacher->name }}" class="w-full border px-4 py-2 rounded">
    <input type="email" name="email" value="{{ $teacher->email }}" class="w-full border px-4 py-2 rounded">
    <input type="password" name="password" placeholder="Laisser vide si inchangé" class="w-full border px-4 py-2 rounded">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Mettre à jour</button>
</form>
@endsection
