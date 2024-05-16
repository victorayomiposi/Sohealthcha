<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class PinMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $existingPin;

    public function __construct($existingPin)
    {
        $this->existingPin = $existingPin;
    }

    public function build()
    {
        $pdf = $this->generatePdf();

        return $this->subject('Ondo State School Of Health Candidate Registration Pin')
            ->attachData($pdf->output(), 'pins.pdf');
    }

    protected function generatePdf()
    {
        $pins = $this->existingPin;
        $pdf = Pdf::loadView('emails.pinpdf', compact('pins'))->setPaper('a4');
         return $pdf;
    }
}
