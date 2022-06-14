<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Crypt;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'message'       => 'required',
            'date'          => 'required',
            'to_email'      => 'required|email',
            'from_email'    => 'required|email',
        ]);

        try {
            $msg = new Message;
            $msg->message = Crypt::encryptString($request->message);
            $msg->token = rand(0, 999);
            $msg->date = date('Y-m-d', strtotime($request->date));
            $msg->to_email = $request->to_email;
            $msg->from_email = $request->from_email;
            $msg->save();

            return response(['message' => 'success'], 200);
        } catch (Exceptions $e) {
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        dd(Crypt::decryptString($message->message));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
