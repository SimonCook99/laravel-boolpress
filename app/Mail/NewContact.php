<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


//oggetto MAILABLE creato da noi, che rappresenta l'email che vogliamo inviare con le informazioni digitate dall'utente
class NewContact extends Mailable
{
    use Queueable, SerializesModels;

    public $lead; //informazioni del singolo utente che compila il form di contatti

    /**
     * Create a new message instance.
     *
     * @return void
     */

    //quando creo un nuovo oggetto "NewContact", passerò le informazioni del singolo utente come parametro,
    //in modo da poter essere passate nella vista chiamata nella funzione "build"
    public function __construct($_lead)
    {
        $this->lead = $_lead;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    //Il metodo BUILD ritorna una vista che rappresenterà il corpo della email che manderemo, esattamente come fosse una vista in blade
    public function build()
    {
        return $this->view('emails.new-contact'); //l'oggetto $lead in questo viene passato alla vista, anche senza usare compact
    }
}
