<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SiteInductionRecordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $data;
    public $attachmentPath;
    public $ccMail;

    public function __construct($data, $attachmentPath,$ccMail)
    {
        $this->data = $data;
        $this->attachmentPath = $attachmentPath; // Path to your attachment file
        $this->ccMail = $ccMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $alldata = $this->data;
        $mail = $this->from(config('mail.from.address'), config('mail.from.name'))
        ->subject('Site Induction Record')
        ->view('template.siteInductionRecord', ['alldata' => $alldata])
        ->attach($this->attachmentPath);

        if (!empty($this->ccMail)) {
            $mail->cc($this->ccMail);
        }

        return $mail; 
    }
}
