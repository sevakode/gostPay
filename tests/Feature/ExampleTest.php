<?php

namespace Tests\Feature;

use App\Models\Bank\Card;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\DataCardsNotification;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Tests\TestCase;

class ExampleTest extends TestCase
{
//    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function user(): User
    {
        return User::query()->find(66);
    }

    public function test1Test()
    {
        $user = $this->user()->cards()->pluck('cards.id')->toArray();
//        DataCardsNotification::createMessage('!!!', $this->user()->cards()->first());
//        $user = $this->user()->cards()->get();
        dd(DataCardsNotification::query($user)->get());
    }
}
