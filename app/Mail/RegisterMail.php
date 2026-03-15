<?php

namespace App\Mail;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $conference_type;
    protected $conference_title;
    protected $conference_fee_title;
    protected $name;
    protected $title;
    protected $code;
    protected $mail_type;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($conference_type, $conference_title, $conference_fee_title, $name, $title, $code, $mail_type,  $locale)
    {
        $this->conference_type = $conference_type;
        $this->conference_title = $conference_title;
        $this->conference_fee_title = $conference_fee_title;
        $this->name = $name;
        $this->title = $title;
        $this->code = $code;
        $this->locale = $locale;
        $this->mail_type = $mail_type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        $mailFrom = $this->from('hoikythuathinhanhyhoc@gmail.com', $this->conference_type);
        $obj = mb_substr($this->code, 2, 2);

        $modelContent = [
            'name'                  => Str::title($this->name),
            'title'                 => $this->title,
            'code'                  => $this->code,
            'mail_type'             => $this->mail_type,
            'obj'                   => $obj,
            'conference_title'      => $this->conference_title,
            'conference_fee_title'  => $this->conference_fee_title
        ];

        switch ($this->locale) {
            case ('vn'):
                $subject = 'Thư mời tham dự hội nghị';

                $invoicePath = storage_path('app/public/invoice/' . $this->code . '.pdf');
                $invitationPath = storage_path('app/public/invitation/' . $this->code . '.pdf');

                $mail = $mailFrom->attach($invoicePath, [
                    'as' => 'Biên lai thu phí.pdf',
                    'mime' => 'application/pdf',
                ]);

                if ($this->mail_type != 'CE' && $obj != 'SV') {
                    $mail = $mailFrom->attach($invitationPath, [
                        'as' => 'Thư mời.pdf',
                        'mime' => 'application/pdf',
                    ]);
                }

                $mail = $mailFrom->with($modelContent)
                        ->view('mail.register.' . Str::lower($this->conference_type) . '.master_template')
                        ->subject($subject);
                    return $mail;
                break;
            case ('en'):
                $mail = $mailFrom->with($modelContent)->view('mail.register.hart.confirm.international')->subject('Invitation to the HART Conference');
                return $mail;
                break;
        }
    }
}
