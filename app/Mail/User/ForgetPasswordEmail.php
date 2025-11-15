<?php

namespace App\Mail\User;

use App\Models\InternalSetting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     */

    public $user;
    public $token;
    public function __construct(User $user, String $token)
    {
        $this->user         = $user;
        $this->token        = $token;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: env('APP_NAME'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $setting = InternalSetting::first(['logo', 'app_name']);
        return new Content(
            view: 'mail.user.password',
            with: [
                'setting' => $setting
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
