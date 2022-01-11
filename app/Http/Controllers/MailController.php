<?php

namespace App\Http\Controllers;

use App\Mail\MyMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        $data = [
            'subject'   => 'Account Activation'
        ];

        Mail::to('ertha.setiyawan86@gmail.com')->send(new MyMail($data));
        return "Email terkirim";
    }
}
