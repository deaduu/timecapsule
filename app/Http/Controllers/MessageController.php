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

        $message = Crypt::encryptString($request->message);
        $encryptString = $this->breakTheString($message);

        $encryptMessage = json_encode([$encryptString[0][0], $encryptString[1][0]]);


        $token =  rand(0, 999); //make the token unique in db

        // dd(Crypt::decryptString($encryptString[0][0] . $encryptString[0][1] . $encryptString[1][1] . $encryptString[1][0]));

        $template = 'index';

        try {
            $msg = new Message;
            $msg->message = $encryptMessage;
            $msg->token = $token;
            $msg->template = $template;
            $msg->date = date('Y-m-d', strtotime($request->date));
            $msg->to_email = $request->to_email;
            $msg->from_email = $request->from_email;
            $msg->save();

            return response(['message' => 'success', 'token_1' => $encryptString[0][1], 'token_2' => $encryptString[1][1], 'token' => $token], 200);
        } catch (Exceptions $e) {
        }
    }

    private function breakTheString($text)
    {

        $splitstring1 = substr($text, 0, floor(strlen($text) / 2));
        $splitstring2 = substr($text, floor(strlen($text) / 2));

        if (substr($splitstring1, 0, -1) != ' ' and substr($splitstring2, 0, 1) != ' ') {
            $middle = strlen($splitstring1) + strpos($splitstring2, ' ') + 1;
        } else {
            $middle = strrpos(substr($text, 0, floor(strlen($text) / 2)), ' ') + 1;
        }

        $string1 = substr($text, 0, $middle - 4);
        $sting1last = substr($text, $middle - 4, 4);


        $string2 = substr($text, $middle + 4);
        $sting2last = substr($text, $middle, 4);

        return [[$string1, $sting1last], [$string2, $sting2last]];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
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


    public function showMessage($token, $token_1, $token_2)
    {
        // http://127.0.0.1:8000/899/UpXU/EMrW


        $page = "index";
        try {
            $getMessage = Message::where('token', $token)->first();

            $message = json_decode($getMessage->message);

            $decryptMessage = Crypt::decryptString($message[0] . $token_1 . $token_2 . $message[1]);
        } catch (\Throwable  $e) {
            return abort(404);
        }



        if ($getMessage->date > date('Y-m-d')) {
            $page = "timer";
            $decryptMessage = '';

            $date = $getMessage->date;
        }



        if ($getMessage->template != 'index') {
        }
        return view('pages.default.' . $page, compact('page', 'decryptMessage', 'date'));
    }
}
