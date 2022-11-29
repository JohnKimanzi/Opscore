<?php

namespace App\Mail;

use App\Models\Employee;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExpiringContractsMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $employees = null;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Employee $emps)
    {
        $this->employees = $emps;
        // $this->employees = Employee::all()->take(10);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.expired_contracts', ['employees'=>$this->employees]);
    }
}
