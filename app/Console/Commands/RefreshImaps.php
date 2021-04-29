<?php

namespace App\Console\Commands;

use App\Models\Bank\Card;
use App\Models\IMAP;
use App\Models\User;
use App\Notifications\DataNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification as Notify;

class RefreshImaps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imaps:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $list = (new IMAP())->refreshMessages();

        foreach ($list as $message) {
            $card = Card::find($message['card_id']);
            $user = $card->user()->select('id');
            Notify::send($user::first(), DataNotification::success('Пришло письмо от почты на карту *'.$card->tail));
        }

        return 0;
    }
}
