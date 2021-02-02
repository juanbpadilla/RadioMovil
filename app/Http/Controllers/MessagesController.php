<?php

namespace App\Http\Controllers;

use Mail;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\CreateMessageRequest;
use App\Events\MessageWasRecived;

class MessagesController extends Controller
{
    function __construct()
    {
        $this->middleware('auth', ['except' => ['create', 'store', 'show', 'index']]);
        $this->middleware('roles:admin,mod', ['except' => ['create', 'store', 'show', 'index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $key = "messages.page." . request('page', 1);

        $messages = Cache::remember($key, 60, function () {
            return Message::with(['user', 'note'])
                    ->orderBy('created_at', request('sorted', 'DESC'))
                    ->paginate(10);
        });

        return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = Message::create($request->all());

        if (auth()->check())
        {
            auth()->user()->messages()->save($message);
        }

        Cache::flush();
        
        event(new MessageWasRecived($message));

        return redirect()->route('mensajes.create')->with('info', 'Hemos recibido tu mensaje');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message =  Cache::rememberForever("messages.{$id}", function () use ($id) {
            $message = Message::findOrFail($id);
        });
        
        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Message::findOrFail($id);
        // $message =  Cache::rememberForever("messages.{$id}", function () use ($id) {
        //     $message = Message::findOrFail($id);
        // });

        return view('messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Message::findOrFail($id)->update($request->all());

        // Cache::flush();

        return redirect()->route('mensajes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Message::findOrFail($id)->delete();

        // Cache::flush();
        
        return redirect()->route('mensajes.index');
    }
}
