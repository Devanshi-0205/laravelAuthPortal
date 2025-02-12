<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class verifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(protected User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        $encryptedUserId = encrypt($this->user->id);

        return $this->subject('Verify Email')
            ->view('emails.email_verify')
            ->with(['user' => $this->user, 'id' => $encryptedUserId]);
    }
}
