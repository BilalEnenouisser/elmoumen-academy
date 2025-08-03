@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Gestion des Témoignages</h1>
        <a href="{{ route('admin.testimonials.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-200">
            ➕ Ajouter un Témoignage
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Image
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nom
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Rôle
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Message
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($testimonials as $testimonial)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($testimonial->image)
                                    <img src="{{ Storage::url($testimonial->image) }}" 
                                         alt="{{ $testimonial->name }}" 
                                         class="h-12 w-12 rounded-full object-cover">
                                @else
                                    <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-400 text-lg">👤</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $testimonial->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $testimonial->role }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 max-w-xs truncate">
                                    {{ Str::limit($testimonial->message, 100) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $testimonial->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $testimonial->is_active ? 'Actif' : 'Inactif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" 
                                       class="text-blue-600 hover:text-blue-900 px-2 py-1 rounded text-sm hover:bg-blue-50 transition-colors">
                                        ✏️ Modifier
                                    </a>
                                    <form action="{{ route('admin.testimonials.toggle-status', $testimonial) }}" 
                                          method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="text-{{ $testimonial->is_active ? 'yellow' : 'green' }}-600 hover:text-{{ $testimonial->is_active ? 'yellow' : 'green' }}-900 px-2 py-1 rounded text-sm hover:bg-{{ $testimonial->is_active ? 'yellow' : 'green' }}-50 transition-colors">
                                            {{ $testimonial->is_active ? '👁️ Désactiver' : '👁️ Activer' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" 
                                          method="POST" class="inline" 
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce témoignage ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 px-2 py-1 rounded text-sm hover:bg-red-50 transition-colors">
                                            🗑️ Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Aucun témoignage trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 