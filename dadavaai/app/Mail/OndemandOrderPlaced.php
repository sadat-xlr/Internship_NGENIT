<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OndemandOrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $quotation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $quotation)
    {
        $this->order = $order;
        $this->quotation = $quotation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(' dadavaai.world@gmail.com')
            ->view('emails.ondemandOrderInvoice');
    }
}
