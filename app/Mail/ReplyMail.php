<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $model;
    protected $type;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($model, $type)
    {
        $this->model = $model;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        $mailFrom = $this->from('hoikythuathinhanhyhoc@gmail.com', 'Vart');
        switch ($this->type) {
            case ('register'):
                $mail_type = $this->model->payment->conference_fee->mail_type;
                $obj = mb_substr($this->model->register_code, 2, 2);
                $modelContent = [
                    'register_gender' => $this->model->register_gender,
                    'register_name' => $this->model->register_name,
                    'register_code' => $this->model->register_code,
                ];
                $subject = 'Thông báo chấp nhận cho phiên khoa học';
                if ($obj == 'CB') {
                    switch ($mail_type) {
                        case (1):
                            $mail = $mailFrom->with($modelContent)->view('mail.theory')->subject($subject);
                            return $mail;
                            break;
                        case (2):
                            $mail = $mailFrom->with($modelContent)->view('mail.practice')->subject($subject);
                            return $mail;
                            break;
                        case (3):
                            $mail = $mailFrom->with($modelContent)->view('mail.online')->subject($subject);
                            return $mail;
                            break;
                    }
                } else {
                    $mail = $mailFrom->with($modelContent)->view('mail.student')->subject($subject);
                    return $mail;
                }
                break;
            case ('en_register'):
                $mail = $mailFrom->with([
                    'en_register_gender' => $this->model->en_register_gender,
                    'en_register_firstname' => $this->model->en_register_firstname,
                    'en_register_lastname' => $this->model->en_register_lastname,
                    'en_register_code' => $this->model->en_register_code,
                ])->view('mail.international')->subject('Notification');
                return $mail;
                break;
        }
    }
}
