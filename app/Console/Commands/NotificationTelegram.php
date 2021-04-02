<?php

namespace App\Console\Commands;

use App\Http\Controllers\NotificationController;
use App\Models\Bank\Card;
use App\Notifications\TelegramNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;

class NotificationTelegram extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:telegram';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Отправка уведомлений - Телеграмм';

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
    public function handle(): int
    {
        NotificationController::sendMessageTelegramNotification();

        return 0;
    }
}
