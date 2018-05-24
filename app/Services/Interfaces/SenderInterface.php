<?php
namespace App\Services\Interfaces;

/**
 * メッセージの送信手段という曖昧(抽象)な物を
 * プログラムで表現するための手段
 * 
 * 具体的な送信手段を定義するクラス(具象クラス)に
 * SenderInterfaceを実装(implements)させる事で
 * sendメソッドの実装を保証する
 */
interface SenderInterface {
    public function send($message);
}