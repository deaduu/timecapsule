<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Crypt;

class MessageController extends Controller
{
    public function getdata(Message $message, $token)
    {
        dd(Crypt::decryptString($message->message . $token));
    }

    public function savemsg(Request $request)
    {
        $msg = new Message;
        $msg->message = Crypt::encryptString($request->message);
        $msg->token = rand(0, 999);
        $msg->date = date('Y-m-d', strtotime($request->date));
        $msg->save();
    }

    public function alldata()
    {
        $data = Message::findOrFail(5);

        $data->token = 112;

        $data->save();

        dd($data);
    }
}
