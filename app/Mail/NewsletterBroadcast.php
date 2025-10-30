<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Newsletter;

class NewsletterBroadcast extends Mailable
{
    use Queueable, SerializesModels;

    public Newsletter $newsletter;

    public function __construct(Newsletter $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    public function build(): self
    {
        return $this->subject('Newsletter: '.$this->newsletter->titre)
            ->view('emails.newsletter')
            ->with(['n' => $this->newsletter]);
    }
}


