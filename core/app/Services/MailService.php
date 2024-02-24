<?php

namespace App\Services;

use App\Services\Interfaces\IMailService;
use Illuminate\Support\Facades\Mail;

class MailService implements IMailService
{
    /**
     * Sent email with attachment
     *
     * @param array $view Email Template and template related data, array key must 'view_name' and 'view_data'
     * @param array $mailData Email Related data (Array Keys are to_email, subject, attachment. attachment is optional)
     * @return void Return Nothing
     */
    public function SentMail(array $view, array $mailData):void
    {
        $fromEmail = env('MAIL_FROM_ADDRESS');
        $fromDisplayName= env('MAIL_FROM_NAME');

        Mail::send($view['view_name'], ['data' => $view['view_data']], function ($message) use ($mailData, $fromEmail, $fromDisplayName) {
            $message->from($fromEmail,$fromDisplayName);
            $message->to($mailData['to_email']);
            $message->subject($mailData['subject']);

            //If Attachment available
            if (array_key_exists("attachment",$mailData)) {
                $message->attach($mailData['attachment']);
            }
        });
    }
}
