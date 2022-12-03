<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailNotificationAdmin extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subject;
    public $msg;
    public $address;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($address,$subject, $msg)
    {
        $this->address = $address;
        $this->subject = $subject;
        $this->msg = $msg;
    }

    /**
 * Build the message.
 *
 * @return $this
 */
    public function build()
    {
        $build = $this->from($this->address, "Tiago")->subject($this->subject)->view('emails/emailNotificationAdmin');

        return $build;
    }
}
