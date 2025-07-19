@extends('admin.layouts.app') {{-- Or your admin layout --}}

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Messages</h1>
    
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 text-left">Name</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-left">Subject</th>
                    <th class="py-3 px-4 text-left">Date</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                <tr class="border-t">
                    <td class="py-3 px-4">{{ $message->name }}</td>
                    <td class="py-3 px-4">{{ $message->email }}</td>
                    <td class="py-3 px-4">{{ $message->subject }}</td>
                    <td class="py-3 px-4">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                    <td class="py-3 px-4">
                        <a href="{{ route('admin.messages.show', $message->id) }}" 
                           class="text-blue-600 hover:text-blue-800">
                            View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $messages->links() }}
    </div>
</div>
@endsection