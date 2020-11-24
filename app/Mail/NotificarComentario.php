<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\ModeloUsuario;
use App\ModeloComentario;
use App\ModeloArticulo;

class NotificarComentario extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $usu,$com,$art;
    public function __construct(ModeloUsuario $usu, ModeloComentario $com, ModeloArticulo $art)
    {
        $this->art=$art;
        $this->com=$com;
        $this->usu=$usu;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('angelzapata582@gmail.com')
                    ->view('comentario');
    }
}
