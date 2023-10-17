<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecivePaymentEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $data_order;

    public function __construct($data_order)
    {
        $this->data_order = $data_order;
    }

    public function build()
    {
        return $this->subject('Bouquet Satgaz Recive Payment')
                    ->view('payment-email');
    }
}
