<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

class TestEmailController extends Controller
{
    public function index()
    {
        Mail::raw(
            'Test email dari sistem Lumpia Kaya Rasa',
            function ($message) {

                $message->to('kazenaraa@gmail.com')
                        ->subject('Test SMTP Laravel');
            }
        );

        return 'Email berhasil dikirim!';
    }
}