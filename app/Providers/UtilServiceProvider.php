<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Services\Interfaces\SenderInterface;
use App\Services\Messenger;

class UtilServiceProvider extends ServiceProvider
{

   /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // \Validator::resolver(function ($translator, $data, $rules, $messages) {
        //     return new CustomValidator($translator, $data, $rules, $messages);
        // });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        dump('Call UtilServiceProvider');
        
        /**
         * レベル3-A
         * 
         * MessengerクラスはSenderInterfaceに依存している
         * SenderInterfaceは抽象であり、実装に変換する必要がある
         * ServiceProviderで抽象->実装への変換を行う
         */
        // $this->app->bind(SenderInterface::class, \App\Services\SlackSender::class);
        
        /**
         * レベル3-B
         * 
         * 抽象 -> 実装の変換に条件付けをする事も可能
         */
        // $this->app->bind(SenderInterface::class, function ($app) {
        //     // dump('必ずしもsenderは生成されない');
        //     if (true) {
        //         return new \App\Services\SlackSender;
        //     } else {
        //         return new \App\Services\MailSender;
        //     }
        // });
        
        /**
         * レベル4
         * 
         * Facadesを利用するために必要
         * App\Facades\Messengerはmessageという名前でコンテナへと問い合わせ
         * コンテナは必要に応じてプロバイダからインスタンスを生成する
         */
        /* Facadesを利用するために必要 */
        // $this->app->bind('message', Messenger::class);
    }
}
