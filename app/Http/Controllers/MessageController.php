<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    /**
     * Display the user's inbox messages.
     */
    public function index()
    {
        $messages = Message::where('receiver_id', auth()->id())->latest()->paginate(10);
        return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for composing a new message.
     */
    public function create()
    {
        $users = User::where('id', '!=', auth()->id())->pluck('name', 'id');
        return view('messages.create', compact('users'));
    }

    /**
     * Store a new message in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'status' => 'Unread',
        ]);

        return redirect()->route('messages.index')->with('success', 'Message sent successfully!');
    }

    /**
     * Display a specific message.
     */
    public function show($id)
    {
        $message = Message::findOrFail($id);
        if ($message->receiver_id == auth()->id()) {
            $message->update(['status' => 'Read']);
        }
        return view('messages.show', compact('message'));
    }

    /**
     * Remove a message.
     */
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        if ($message->receiver_id == auth()->id() || $message->sender_id == auth()->id()) {
            $message->delete();
        }
        return redirect()->route('messages.index')->with('success', 'Message deleted successfully!');
    }
}
