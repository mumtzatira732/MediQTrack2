<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Clinic;

class ClinicApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $clinic;

    public function __construct(Clinic $clinic)
    {
        $this->clinic = $clinic;
    }

    public function build()
    {
        return $this->subject('Your clinic has been approved!')
                    ->view('emails.clinic_approved');
    }
}
