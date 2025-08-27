<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LabTestResultMail extends Mailable
{
    use Queueable, SerializesModels;

    public $labtest;

    public function __construct($labtest)
    {
        $this->labtest = $labtest;
    }

    public function build()
    {
        return $this->subject('Your Lab Test Report')
            ->view('layouts.email.labtest')
            ->attach(storage_path('app/public/test_details/' . $this->labtest->test_detail));
    }
}
