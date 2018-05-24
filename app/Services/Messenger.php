<?php 
namespace App\Services;

use App\Services\Interfaces\SenderInterface;
use App\Services\SlackSender;

class Messenger {
    
    /**
     * メッセージを送信する手段
     * 
     * @var SenderInterface $sender
     */
    protected $sender;
    
    /**
     * レベル1
     * 
     * メッセージの送信手段を直接インスタンス化
     * BikeSenderに依存している状態
     */
    public function __construct() {
        $this->sender = new SlackSender;
    }
    
    /**
     * レベル2
     * 
     * メッセージの送信手段を引数に指定(注入)
     * 外部から送信手段を注入できる状態
     * 外部から注入してあげないと必須項目が足りないためエラーが起きる
     * タイプヒントを使用する場合は、BikeSender/MailSenderどちらかを選択しないといけない
     */
    // public function __construct($sender) {
    //     $this->sender = new $sender;
    // }

    /**
     * レベル3
     * 
     * メッセージの送信手段を引数に指定(注入)
     * Interfaceを使用する事で、具体的な手段(Mail or Bike)をここで指定しなくて済む
     * サービスプロバイダで適切な設定を行う事で、
     * インタフェース名に応じたインスタンス生成が自動的に行われる
     * 
     * @var SenderInterface $sender
     */
    // public function __construct(SenderInterface $sender) {
    //     $this->sender = $sender;
    // }

    /**
     * 送信手段に応じてメッセージの送信を行う
     * 
     * @var string $message
     */
    public function send($message) {
        return $this->sender->send($message);
    }
}