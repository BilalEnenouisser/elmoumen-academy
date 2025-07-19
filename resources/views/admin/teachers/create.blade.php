@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Ajouter un enseignant</h1>

<form action="{{ route('admin.teachers.store') }}" method="POST" class="space-y-4 max-w-md">
    @csrf
    <input type="text" name="name" placeholder="Nom" class="w-full border px-4 py-2 rounded" required>
    <input type="email" name="email" placeholder="Email" class="w-full border px-4 py-2 rounded" required>
    <input type="password" name="password" placeholder="Mot de passe" class="w-full border px-4 py-2 rounded" required>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Ajouter</button>
</form>
@endsection
