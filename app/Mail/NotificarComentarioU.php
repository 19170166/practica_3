<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use App\ModeloComentario;
use App\ModeloArticulo;
use Illuminate\Queue\SerializesModels;

class NotificarComentarioU extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $com,$art;
    public function __construct(ModeloComentario $com,ModeloArticulo $art)
    {
        $this->com=$com;
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
                    ->view('comentariou');
    }
}
