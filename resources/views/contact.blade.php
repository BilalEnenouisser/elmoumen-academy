@if(session('success'))
    <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('messages.store') }}" class="space-y-4">
    @csrf

    <input type="text" name="name" placeholder="Nom" class="w-full p-2 border rounded" required>
    <input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded" required>
    <input type="text" name="subject" placeholder="Sujet" class="w-full p-2 border rounded" required>
    <textarea name="message" placeholder="Message" class="w-full p-2 border rounded" rows="5" required></textarea>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Envoyer</button>
</form>
