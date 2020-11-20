<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\ModeloUsuario;

class ConfirmarRegistro extends Mailable
{
    use Queueable, SerializesModels;

    public $usu;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ModeloUsuario $usu)
    {
        $this->usu = $usu;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@gmail.com')
                    ->view('prueba');
                    
    }
}
