<?php
namespace App\Services;
use App\Services\Interfaces\SenderInterface;

class SlackSender implements SenderInterface {

    /**
     * Slackでメッセージの送信を行う
     * 
     * @var string $message
     */
    public function send($message) {
        return $message . 'をSlackで送信';
    }
}