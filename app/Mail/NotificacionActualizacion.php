<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionActualizacion extends Mailable
{
    use Queueable, SerializesModels;
    public $permiso;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $permiso)
    {
        $this->permiso=$permiso;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('angelzapata582@gmail.com')
                    ->view('actualizacion');
    }
}
