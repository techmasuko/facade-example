<?php
namespace App\Services;
use App\Services\Interfaces\SenderInterface;

class MailSender implements SenderInterface {

    public function send($message) {
        return $message . 'をメール便で届けました';
    }
}