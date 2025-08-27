<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailyAppointmentsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appointments;
    public $doctor;

    public function __construct($doctor, $appointments)
    {
        $this->doctor = $doctor;
        $this->appointments = $appointments;
    }

    public function build()
    {
        return $this->subject('Your Appointments for Today')
            ->view('layouts.email.listAppointment');
    }
}
