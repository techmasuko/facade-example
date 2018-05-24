<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Services\Messenger; // レベル1〜3
use Illuminate\Support\Facades\App;
use App\Services\SlackSender;
use App\Services\Interfaces\SenderInterface;
// use App\Facades\Messenger; // レベル4

class MessagesController extends Controller
{
    /**
     * @var App\Services\Messenger $messenger
     */
    protected $messenger;
    
    /**
     * レベル3-2
     * 
     * メソッドの引数にタイプヒントのクラスを指定すると
     * クラス情報を元に自動的にインスタンスが生成される
     * 
     * Messengerクラスが依存しているクラス(Messenger)が
     * わかりやす事もあり、使用頻度は多い
     * 
     * constructorだけでなく、indexやshowなどのメソッドでも同様の事が可能
     */
    // public function __construct(Messenger $messenger)
    // {
    //     $this->messenger = $messenger;
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * レベル1
         * 
         * インスタンス化はシンプルだが
         * メッセージの送信手段は固定されている(密結合)
         */
        $this->messenger = new Messenger;
        
        /**
         * レベル2
         * 
         * メッセージの送信手段を外部から注入できるが
         * 注入を行うための設定が面倒
         * 複数箇所でMessengerが必要な場合は重複が発生する
         */
        // $this->messenger = new Messenger(new SlackSender);
        
        /**
         * レベル3-1
         * 
         * コンストラクターインジェクション(レベル3-2)だと
         * 自動的にインスタンス生成を行なってくれるが、
         * 通常のインスタンス化(new Messenger)では引数不足でエラーになる
         * 依存解決をコンテナ経由で行うため App::make/resolve を使用する
         */
        // $this->messenger = App::make(Messenger::class);
        // $this->messenger = resolve(Messenger::class);
        
        /**
         * レベル1〜3
         * 
         * 通常のメソッド呼び出し
         */
        echo $this->messenger->send('hello');
        echo $this->messenger->send('hello');
        
        /**
         * レベル4
         * 
         * Facades経由のメソッド呼び出し
         * 
         * 非常に簡単にsendメソッドを呼び出す事ができる
         * 裏側でインスタンスの生成が行われるが
         * Facades自身でインスタンスのキャッシュが行われるため
         * 無駄なインスタンス生成処理が行われない
         * 
         * MessengersControllerが依存しているクラス
         * (この場合はMessenger)がわかりづらくなるのがデメリット
         * 必ずしもレベル3より優れているわけではない
         */
        // echo Messenger::send('hello');
        // echo Messenger::send('hello');
        
        // messages.index ここはルート名ではなくてファイル名
        return view('messages.index', [
            'messages' => Message::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $message = new Message;

        return view('messages.create', [
            'message' => $message,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:191',   // 追加
            'content' => 'required|max:191',
        ]);

        $message = new Message;
        $message->fill($request->all());
        $message->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {

        return view('messages.show', [
            'message' => $message,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Message::find($id);

        return view('messages.edit', [
            'message' => $message,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //1
    {
        $this->validate($request, [
            'title' => 'required|max:191',   // 追加
            'content' => 'required|max:191',
        ]);
        
        $message = Message::find($id);
        $message->fill($request->all());
        $message->save();

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $message = Message::find($id);
        $message->delete(); // DELETE FROM messages where id = ?;

        return redirect('/');
    }
}
