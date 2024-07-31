<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $name;
    protected $title;
    protected $code;
    protected $mail_type;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $title, $code, $mail_type,  $locale)
    {
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
        $mailFrom = $this->from('hoikythuathinhanhyhoc@gmail.com', 'Hart');
        $modelContent = [
            'name' => $this->name,
            'title' => $this->title,
            'code' => $this->code,
        ];
        switch ($this->locale) {
            case ('vn'):
                $obj = mb_substr($this->code, 2, 2);
                $subject = 'Thư mời tham dự hội nghị thường niên HART 2024';
                $path = storage_path('app/public/receipt/hart/' . $this->code . '.pdf');
                if ($obj == 'CB') {
                    switch ($this->mail_type) {
                        case (1):
                            $mail = $mailFrom->with($modelContent)
                            ->view('mail.register.hart.confirm.theory')
                            ->attach($path, [
                                'as' => 'Biên lai thu phí.pdf',
                                'mime' => 'application/pdf',
                            ])
                            ->subject($subject);
                            return $mail;
                            break;
                        case (2):
                            $mail = $mailFrom->with($modelContent)
                            ->view('mail.register.hart.confirm.practice')
                            ->attach($path, [
                                'as' => 'Biên lai thu phí.pdf',
                                'mime' => 'application/pdf',
                            ])
                            ->subject($subject);
                            return $mail;
                            break;
                        case (3):
                            $mail = $mailFrom->with($modelContent)
                            ->view('mail.register.hart.confirm.online')
                            ->attach($path, [
                                'as' => 'Biên lai thu phí.pdf',
                                'mime' => 'application/pdf',
                            ])
                            ->subject($subject);
                            return $mail;
                            break;
                    }
                } else {
                    $mail = $mailFrom->with($modelContent)
                    ->view('mail.register.hart.confirm.student')
                    ->attach($path, [
                        'as' => 'Biên lai thu phí.pdf',
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
