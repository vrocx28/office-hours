<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class emailController extends Controller
{
    public function sendemail()
    {
        $to_name = "developer";
            $to_email = "vaibhavbansal28@gmail.com";
            $data = "message here";
            Mail::raw($data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject("Laravel Test Mail");
                $message->from("vaibhdev28@gmail.com", "Dev lord");
            });
    }
}
