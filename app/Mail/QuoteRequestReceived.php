<?php

namespace App\Mail;

use App\Models\QuoteRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuoteRequestReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public QuoteRequest $quoteRequest)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New cabinet quote request from '.$this->quoteRequest->name,
            replyTo: [$this->quoteRequest->email],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.quote-request-received',
        );
    }

    /** @return array<int, Attachment> */
    public function attachments(): array
    {
        return collect($this->quoteRequest->attachment_paths ?? [])
            ->map(fn (string $path) => Attachment::fromStorageDisk('local', $path))
            ->all();
    }
}
