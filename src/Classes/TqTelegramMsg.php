<?php

namespace Taq\Tqadmtpl\Classes;

// use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Http;

/**
 * useage
 * $messages = (new TqTelegramMsg)->sendTelegram('test');
 * $messages = (new TqTelegramMsg)->set(TOKEN,CHATID)->sendTelegram('test');
 **/
class TqTelegramMsg
{
    protected $telegramBotToken;
    protected $telegramChatId;

    public function __construct()
    {
        $this->telegramBotToken = config('tqadmtpl.telegram.bot_token', '');
        $this->telegramChatId = config('tqadmtpl.telegram.chat_id', ''); // 7869633202

        return $this;
    }
    public function set($token, $chatid){
        $this->telegramBotToken = $token;
        $this->telegramChatId = $chatid;
        return $this;
    }
    public function getConfig(){
        return [
            'telegramBotToken'=>$this->telegramBotToken,
            'telegramChatId'=>$this->telegramChatId,
        ];
    }
    public function sendTelegram($message)
    {
        if (! $this->telegramChatId) {
            $this->getMyId();
        }
        try {
            $res = Http::get("https://api.telegram.org/bot{$this->telegramBotToken}/sendMessage?chat_id={$this->telegramChatId}&text={$message}")->json();

            if ( !$res['ok'] ) {
                throw new \Exception('봇아이디를 확인해주세요(2)');
            }

            return $res['result'];
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getUpdates()
    {
        try {
            $res = Http::get("https://api.telegram.org/bot{$this->telegramBotToken}/getUpdates")->json();
            if (! $res['ok']) {
                throw new \Exception('봇아이디를 확인해주세요(1)');
            }

            return $res['result'];
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getMyId()
    {
        $res = $this->getUpdates();
        $lastid = null;
        $firstmsg = null;
        $method = '/start  를 검색해서 찾은 chatid : ';

        foreach ($res as $update) {
            if ($update['message']['text'] == '/start') {
                $lastid = $update['message']['from']['id'];
            }
            if (! $firstmsg) {
                $firstmsg = $update['message']['from']['id'];
            }
        }
        if (! $lastid) {
            if ($firstmsg) {
                $method = '가장 처음 메시지를 입력한 chatid : ';
                $this->telegramChatId = $firstmsg['message']['from']['id'];
            } else {
                throw new \Exception('채팅룸에서 /start 를 쳐주세요');
            }
        }
        $this->telegramChatId = $lastid;

        return $method.$this->telegramChatId;
    }
}