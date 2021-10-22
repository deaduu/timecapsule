<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function getdata(Message $message)
    {
        dd($message->message);
    }

    public function savemsg(Request $request)
    {
        $msg = new Message;
        $msg->message = $request->message;
        $msg->token = rand(0, 999);
        $msg->date = date('Y-m-d');
        $msg->save();
    }
}
