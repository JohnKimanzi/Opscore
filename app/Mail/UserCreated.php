<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCreated extends Mailable
{
    use Queueable, SerializesModels;

    protected $recipient=null;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $u)
    {
        $this->recipient = $u;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.usercreated')
                    ->with('recipient',$this->recipient);
    }
}