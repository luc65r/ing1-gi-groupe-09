<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Models\MessageUser; 
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('messages.index', ['messages' => auth()->user()->messagesRecieved]);
    }

    /**
     * Show the form for creating a new resource.
     *
     
     */
    public function create()
    {
        $users = User::all();
        return view('messages.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageRequest $request)
{
    $request->validate([
        'subject' => ['required', 'string', 'max:255'],
        'body' => ['required', 'string'],
        'recievers' => ['required', 'array', 'min:1'],
        'recievers.*' => ['required', 'string', 'exists:App\Models\User,email'],
    ]);

    $msg = auth()->user()->messages()->create([
        'subject' => $request->subject,
        'body' => $request->body,
    ]);

    $msg->recievers()->attach($request->recievers);

    return redirect()->route('messages.index');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return view('messages.show', compact('message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }

    public function sent()
    {
        return view('messages.sent', ['messages' => auth()->user()->messagesSent]);
    }
    public function searchUsers(Request $request)
{
    
    $users = User::all();

    dd($users);
    return response()->json($users);
}

    
}