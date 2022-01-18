<?php

namespace App\Mail\Reserve;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to('yuto.fukaya@cab-station.com') 
                ->from('info@mystery-travelagency.com')
                ->subject('「謎解キ旅行社」ご依頼内容予約ページより送信されました')
                ->view('contact.reserve.admin')->with(['data' => $this->data]);
    }
}
