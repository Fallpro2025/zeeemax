<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageReceived extends Mailable
{
    use Queueable, SerializesModels;

    public array $donnees;

    public function __construct(array $donnees)
    {
        $this->donnees = $donnees;
    }

    public function build(): self
    {
        return $this->subject('Nouveau message de contact: ' . ($this->donnees['subject'] ?? ''))
            ->view('emails.contact_message')
            ->with(['d' => $this->donnees]);
    }
}


