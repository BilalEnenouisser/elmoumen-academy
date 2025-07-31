@extends('layouts.admin')

@section('title', 'Gestion des Messages')

@section('content')
    <h1 class="text-2xl font-bold mb-6">✉️ Messages de Contact</h1>

    <!-- Mobile Cards View -->
    <div class="lg:hidden space-y-4">
        @foreach($messages as $message)
            <div class="bg-white rounded-lg shadow p-4 @if(!$message->read) border-l-4 border-blue-500 @endif">
                <div class="flex justify-between items-start mb-3">
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900">{{ $message->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $message->email }}</p>
                        <p class="text-sm text-gray-500 mt-1">{{ $message->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    @if(!$message->read)
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">Nouveau</span>
                    @endif
                </div>
                <div class="mb-3">
                    <p class="text-sm font-medium text-gray-900 mb-1">Sujet :</p>
                    <p class="text-sm text-gray-700">{{ $message->subject }}</p>
                </div>
                <a href="{{ route('admin.messages.show', $message->id) }}" 
                   class="block w-full text-center bg-blue-100 text-blue-700 px-3 py-2 rounded text-sm hover:bg-blue-200 transition-colors">
                    Voir le Message
                </a>
            </div>
        @endforeach
    </div>

    <!-- Desktop Table View -->
    <div class="hidden lg:block">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sujet</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($messages as $message)
                    <tr class="@if(!$message->read) bg-blue-50 @endif hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $message->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $message->email }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $message->subject }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('admin.messages.show', $message->id) }}" 
                               class="text-blue-600 hover:text-blue-900 transition-colors">
                                Voir
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $messages->links() }}
    </div>
@endsection