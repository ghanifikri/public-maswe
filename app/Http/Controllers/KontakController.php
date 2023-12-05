<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\StoreKontakRequest;
use App\Models\Message;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        return view('frontend.kontak.index');
    }

    public function store(StoreKontakRequest $request)
    {
        $message = Message::create($request->all());

        $data=array();
        $data['url']=route('kontak.show',$message->id);
        $data['date']=$message->created_at->format('F d, Y h:i A');
        $data['name']=$message->name;
        $data['email']=$message->email;
        $data['message']=$message->message;
        $data['subject']=$message->subject;
        $data['photo']=Auth()->user()->avatar;
        //return $data;    
        event(new MessageSent($data));
        exit();
    }

    public function messageFive()
    {
        $message = Message::whereNull('read_at')->limit(5)->get();
        return response()->json($message);
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);
        if ($message) {
            $message->read_at = \Carbon\Carbon::now();
            $message->save();
            return view('admin.MessagePage.message.show', compact('message'));
        } else {
            return view('admin.MessagePage.message.show', compact('message'));
        }
        
    }

    public function message()
    {
        $messages = Message::all();
        return view('admin.MessagePage.message.index', compact('messages'));
    }
}
