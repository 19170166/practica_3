<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\ModeloUsuario;

class NotificarAccion extends Mailable
{
    use Queueable, SerializesModels;
    public $usu;
    public $mensaje;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ModeloUsuario $usu,String $mensaje)
    {
        $this->usu=$usu;
        $this->mensaje=$mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('angelzapata582@gmail.com')
                    ->view('notificacion');
    }
}
