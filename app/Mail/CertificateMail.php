<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CertificateMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $conference_type;
    protected $conference_title;
    protected $title;
    protected $name;
    protected $code;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($conference_type, $conference_title, $name, $title, $code, $locale)
    {
        $this->conference_type = $conference_type;
        $this->conference_title = $conference_title;
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
        switch ($this->conference_type) {
            case ('VART'):
                $mailFrom = $this->from('hoikythuathinhanhyhoc@gmail.com', 'VART');
                $objType = 'vart';
                break;
            case ('HART'):
                $mailFrom = $this->from('hoikythuathinhanhyhoc@gmail.com', 'HART');
                $objType = 'hart';
                break;
            case ('HRTTA'):
                $mailFrom = $this->from('hoikythuathinhanhyhoc@gmail.com', 'HRTTA');
                $objType = 'hrtta';
                break;
        }
        $certificatePath = storage_path('app/public/certificate/' . $this->code . '.pdf');
        switch ($this->locale) {
            case ('vn'):
                $modelContent = [
                    'title' => $this->title,
                    'name' => $this->name,
                    'conference_title' => $this->conference_title,
                ];

                $mail = $mailFrom->with($modelContent)
                    ->view('mail.certificate.' . $objType . '.national')
                    ->attach($certificatePath, [
                        'as' => 'Giấy chứng nhận CME.pdf',
                        'mime' => 'application/pdf',
                    ])
                    ->subject('GIẤY CHỨNG NHẬN CME HỘI NGHỊ 2025 - ĐÀ NẴNG');

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
