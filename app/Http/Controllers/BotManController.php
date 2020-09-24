<?php

namespace App\Http\Controllers;

use App\Conversations\ExampleConversation;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Attachments\File;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('/start|help|start|info|test' , function ($bot) {
            $bot->reply(
            <<<EOT
            Hai saya adalah AdministrasiKDCW Chatbot, silahkan bertanya seputar administrasi di KeDai Computerworks dengan cara mengirim perintah seperti di bawah ini :
            
            /test [****]
            Untuk menemukan informasi.
EOT
        );
        });

        //Fallback Error
        $botman->fallback(function($bot) {
            $bot->reply('Perintah yang anda input salah !, untuk mengetahui perintah yang ada silakan masukkan perintah /start atau help');
        });

        $botman->listen();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tinker()
    {
        return view('tinker');
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public function startConversation(BotMan $bot)
    {
        $bot->startConversation(new ExampleConversation());
    }
}
