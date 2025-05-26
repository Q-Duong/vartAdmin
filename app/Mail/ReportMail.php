<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $conference_type;
    protected $conference_title;
    protected $title;
    protected $name;
    protected $code;
    protected $suggestedAddition;
    protected $reasonRejection;
    protected $status;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($conference_type, $conference_title, $name, $title, $code, $suggestedAddition, $reasonRejection, $status, $locale)
    {
        $this->conference_type = $conference_type;
        $this->conference_title = $conference_title;
        $this->title = $title;
        $this->name = $name;
        $this->code = $code;
        $this->suggestedAddition = $suggestedAddition;
        $this->reasonRejection = $reasonRejection;
        $this->status = $status;
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
        $invitationPath = storage_path('app/public/invitation/' . $this->code . '.pdf');
        switch ($this->locale) {
            case ('vn'):
                $modelContent = [
                    'title' => $this->title,
                    'name' => $this->name,
                    'code' => $this->code,
                    'conference_title' => $this->conference_title,
                    'suggestedAddition' => $this->suggestedAddition,
                    'reasonRejection' => $this->reasonRejection,
                ];
                if ($this->status == 3) {
                    $mail = $mailFrom->with($modelContent)
                    ->view('mail.report.' . $objType . '.accept')
                    ->attach($invitationPath, [
                        'as' => 'Thư mời.pdf',
                        'mime' => 'application/pdf',
                    ])
                    ->subject('Thư mời tham gia báo cáo');
                } elseif ($this->status == 4) {
                    $mail = $mailFrom->with($modelContent)
                    ->view('mail.report.' . $objType . '.reject')
                    ->subject('Thông báo bình duyệt bài báo cáo');
                }
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
