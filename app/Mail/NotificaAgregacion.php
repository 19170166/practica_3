<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\ModeloArticulo;

class NotificaAgregacion extends Mailable
{
    use Queueable, SerializesModels;
    public $art;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ModeloArticulo $art)
    {
        $this->art=$art;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('angelzapata582@gmail.com')
                    ->view('agregado');
    }
}
