<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClinicRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $clinic;

    public function __construct($clinic)
    {
        $this->clinic = $clinic;
    }

    public function build()
    {
        return $this->subject('Your Clinic Registration Has Been Rejected')
                    ->view('emails.clinic_rejected');
    }
}

