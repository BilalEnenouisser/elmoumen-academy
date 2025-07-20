@extends('layouts.admin')

@section('title', 'Messages')

@section('content')
<div class="overflow-x-auto">
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
            <tr class="@if(!$message->read) bg-blue-50 @endif">
                <td class="px-6 py-4 whitespace-nowrap">{{ $message->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $message->email }}</td>
                <td class="px-6 py-4">{{ $message->subject }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <a href="{{ route('admin.messages.show', $message->id) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $messages->links() }}
</div>
@endsection