<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Schema;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }

    public function show($id)
    {
    $message = Message::findOrFail($id);
    
    // Only update if column exists
    if (Schema::hasColumn('messages', 'read')) {
        $message->update(['read' => true]);
    }
    
    return view('admin.messages.show', compact('message'));
    }

    //MessageController store method add by deepsek

    public function store(Request $request)
{
    $validated = $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    Message::create($validated); // Only use validated data

    return back()->with('success', 'Message sent successfully!');
}
}
