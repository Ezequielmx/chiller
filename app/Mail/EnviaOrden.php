<?php

namespace App\Mail;

use App\Models\Ordene;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;
use App\Models\User;


class EnviaOrden extends Mailable
{
    use Queueable, SerializesModels;


    public $fromMail;
    public $fromName;
    public $orden;
    public $path;
    /**
     * Create a new message instance.
     */
    public function __construct($fromMail, $fromName, $orden_id, $path)
    {
        $this->fromName = $fromName;
        $this->fromMail = $fromMail;
        $this->orden = Ordene::find($orden_id);
        $this->path = 'app/' .  $path;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

        $ccEmails = [];
        //put into ccEmails all the user->email  of the users table who have user->copiamail = 1
        foreach (User::all() as $user) {
            if ($user->copiamail == 1) {
                array_push($ccEmails, $user->email);
            }
        }

        return new Envelope(
            from: new Address(
                address: $this->fromMail,
                name: $this->fromName,
            ),
            subject: 'Nueva Orden de Retiro',
            bcc: array_map(function ($email) {
                return new Address(address: $email);
            }, $ccEmails),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.envia_orden',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath(storage_path( $this->path))
        ];
    }
}
