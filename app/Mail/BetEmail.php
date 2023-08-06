<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BetEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $data)
    {
        $this->user = $user;
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    // public function envelope()
    // {
    // }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    // public function content()
    // {
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    // public function attachments()
    // {
    // }

    public function build()
    {
        $subjectEmail = config('content.subject_email');
        $view = $this->data['themeName'];
        $nameOfPDF = $this->user->email . time() . rand(10000, 99999)  . '.pdf';
        return $this
            ->view($view, ['user' => $this->user, 'data' => $this->data])
            ->subject($subjectEmail)
            ->attachData($this->data['file'], $nameOfPDF);
    }
}
