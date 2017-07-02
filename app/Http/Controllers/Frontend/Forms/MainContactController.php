<?php

namespace App\Http\Controllers\Frontend\Forms;

use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class MainContactController
{
    use ValidatesRequests;

    public function index(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'message' => 'required|max:500'
        ]);

        if (! $this->mail($request)) {
            return back()->withInput()->with('status', 'Email not sent');
        }
        return back()->withInput()->with('status', 'Email sent');
    }

    //
    public function mail(Request $request)
    {
        $data = [
            'data' => $request->all(),
            ];

        $mail = Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->from('test@email.com', 'CMS test');
            $message->to($data['data']['email'], $data['data']['name'])->subject('Your Reminder!');
        });

        if (! $mail) {
            return false;
        }
        return true;
    }
}
