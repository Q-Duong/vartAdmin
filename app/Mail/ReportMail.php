<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $title;
    protected $name;
    protected $code;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $title, $code, $locale)
    {
        $this->title = $title;
        $this->name = $name;
        $this->code = $code;
        $this->locale = $locale;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        $mailFrom = $this->from('hoikythuathinhanhyhoc@gmail.com', 'Hart');
        switch ($this->locale) {
            case ('vn'):
                $modelContent = [
                    'title' => $this->title,
                    'name' => $this->name,
                ];
                $subject = 'Xác nhận nộp bài báo cáo';
                $mail = $mailFrom->with($modelContent)->view('mail.report.hart.national')->subject($subject);
                return $mail;

                break;
            case ('en'):
                $modelContent = [
                    'title' => $this->title,
                    'name' => $this->name,
                    'code' => $this->code,
                ];
                $subject = 'Confirmation of report submission';
                $mail = $mailFrom->with($modelContent)->view('mail.report.hart.international')->subject($subject);
                return $mail;
                break;
        }
    }
}
