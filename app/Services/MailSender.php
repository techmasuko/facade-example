<?php
namespace App\Services;
use App\Services\Interfaces\SenderInterface;

class MailSender implements SenderInterface {

    /**
     * メールでメッセージの送信を行う
     * 
     * @var string $message
     */
    public function send($message) {
        return $message . 'をメール便で送信';
    }
}