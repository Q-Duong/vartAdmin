<?php

namespace App\Mail;

use Illuminate\Support\Str;
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
        $mailFrom = $this->from('hoikythuathinhanhyhoc@gmail.com', $this->conference_type);

        $modelContent = [
            'title' => $this->title,
            'name' => Str::title($this->name),
            'code' => $this->code,
            'conference_title' => $this->conference_title,
            'suggestedAddition' => $this->suggestedAddition,
            'reasonRejection' => $this->reasonRejection,
        ];

        $invitationPath = storage_path('app/public/invitation/' . $this->code . '.pdf');

        switch ($this->locale) {
            case ('vn'):
                if ($this->status == 3) {
                    $mail = $mailFrom->with($modelContent)
                        ->view('mail.report.' . Str::lower($this->conference_type) . '.accept')
                        ->attach($invitationPath, [
                            'as' => 'Thư mời.pdf',
                            'mime' => 'application/pdf',
                        ])
                        ->subject('Thư mời tham gia báo cáo');
                } elseif ($this->status == 4) {
                    $mail = $mailFrom->with($modelContent)
                        ->view('mail.report.' . Str::lower($this->conference_type) . '.reject')
                        ->subject('Thông báo bình duyệt bài báo cáo');
                }
                return $mail;

                break;
            case ('en'):
                $mail = $mailFrom->with($modelContent)
                    ->view('mail.report.' . Str::lower($this->conference_type) . '.international')
                    ->attach($invitationPath, [
                        'as' => 'INVITATION LETTER.pdf',
                        'mime' => 'application/pdf',
                    ])
                    ->subject('Presentation Invitation Letter');
                return $mail;
                break;
        }
    }
}
