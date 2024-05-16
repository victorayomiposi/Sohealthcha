<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $customerId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customerId)
    {
        $this->customerId = $customerId;
    }

    public function build()
    {
        $customerId = $this->customerId;
        $pinStoreExists = DB::table('pinstore')->where('customer_id', $customerId)->first();
       
        return $this->view('emails.pinpdf', ['pinStoreExists' => $pinStoreExists])
                    ->subject('Ondo State School Of Health Candidate Registration Pin');
    }
}
