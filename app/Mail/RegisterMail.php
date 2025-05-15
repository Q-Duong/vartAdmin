<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $conference_type;
    protected $conference_title;
    protected $name;
    protected $title;
    protected $code;
    protected $mail_type;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($conference_type, $conference_title, $name, $title, $code, $mail_type,  $locale)
    {
        $this->conference_type = $conference_type;
        $this->conference_title = $conference_title;
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
        $modelContent = [
            'name' => $this->name,
            'title' => $this->title,
            'code' => $this->code,
            'conference_title' => $this->conference_title
        ];
        switch ($this->locale) {
            case ('vn'):
                $obj = mb_substr($this->code, 2, 2);
                $subject = 'Thư mời tham dự hội nghị';
                switch ($this->conference_type) {
                    case ('VART'):
                        $mailFrom = $this->from('hoikythuathinhanhyhoc@gmail.com', 'VART');
                        break;
                    case ('HART'):
                        $mailFrom = $this->from('hoikythuathinhanhyhoc@gmail.com', 'HART');
                        break;
                    case ('HRTTA'):
                        $mailFrom = $this->from('hoikythuathinhanhyhoc@gmail.com', 'HRTTA');
                        break;
                }
                $invoicePath = storage_path('app/public/invoice/' . $this->code . '.pdf');
                $invitationPath = storage_path('app/public/invitation/' . $this->code . '.pdf');
                if ($obj == 'CB') {
                    switch ($this->mail_type) {
                        case (1):
                            $mail = $mailFrom->with($modelContent)
                            ->view('mail.register.vart.confirm.theory')
                            ->attach($invoicePath, [
                                'as' => 'Biên lai thu phí.pdf',
                                'mime' => 'application/pdf',
                            ])
                            ->attach($invitationPath, [
                                'as' => 'Thư mời.pdf',
                                'mime' => 'application/pdf',
                            ])
                            ->subject($subject);
                            return $mail;
                            break;
                        case (2):
                            $mail = $mailFrom->with($modelContent)
                            ->view('mail.register.vart.confirm.practice')
                            ->attach($invoicePath, [
                                'as' => 'Biên lai thu phí.pdf',
                                'mime' => 'application/pdf',
                            ])
                            ->attach($invitationPath, [
                                'as' => 'Thư mời.pdf',
                                'mime' => 'application/pdf',
                            ])
                            ->subject($subject);
                            return $mail;
                            break;
                        case (3):
                            $mail = $mailFrom->with($modelContent)
                            ->view('mail.register.vart.confirm.online')
                            ->attach($invoicePath, [
                                'as' => 'Biên lai thu phí.pdf',
                                'mime' => 'application/pdf',
                            ])
                            ->attach($invitationPath, [
                                'as' => 'Thư mời.pdf',
                                'mime' => 'application/pdf',
                            ])
                            ->subject($subject);
                            return $mail;
                            break;
                    }
                } else {
                    $mail = $mailFrom->with($modelContent)
                    ->view('mail.register.vart.confirm.student')
                    ->attach($invoicePath, [
                        'as' => 'Biên lai thu phí.pdf',
                        'mime' => 'application/pdf',
                    ])
                    ->attach($invitationPath, [
                        'as' => 'Thư mời.pdf',
                        'mime' => 'application/pdf',
                    ])
                    ->subject($subject);
                    return $mail;
                }
                break;
            case ('en'):
                $mail = $mailFrom->with($modelContent)->view('mail.register.hart.confirm.international')->subject('Invitation to the HART Conference');
                return $mail;
                break;
        }
    }
}
