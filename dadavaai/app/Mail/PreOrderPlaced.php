<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PreOrderPlaced extends Mailable
{
    use Queueable, SerializesModels;
    public $preorder;
    public $prebook;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($preorder, $prebook )
    {
        $this->preorder = $preorder;
        $this->prebook = $prebook;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(' dadavaai.world@gmail.com')
            ->view('emails.preorder');
    }
}
