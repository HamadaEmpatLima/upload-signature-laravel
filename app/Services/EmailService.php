<?php

namespace App\Services;

use App\Mail\UserVerification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function userVerification(User $user, $token)
    {
        Mail::to($user->email)->queue(new UserVerification($user, $token));
    }
}
