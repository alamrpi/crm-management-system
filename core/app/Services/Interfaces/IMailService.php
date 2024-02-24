<?php

namespace App\Services\Interfaces;

interface IMailService
{
    /**
     * Sent email with attachment
     *
     * @param array $view Email Template and template related data, array key must 'view_name' and 'view_data'
     * @param array $mailData Email Related data (Array Keys are to_email, subject, attachment. attachment is optional)
     * @return void Return Nothing
     */
    public function SentMail(array $view, array $mailData): void;
}
