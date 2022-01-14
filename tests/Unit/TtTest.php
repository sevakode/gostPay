<?php

namespace Tests\Unit;

use App\Models\Bank\BankToken;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\TestCase;

class TtTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function bank(): BankToken
    {
        dd(BankToken::query()->get());
        return BankToken::query()->where('url', 'https://business.tinkoff.ru')->first();
        return BankToken::query()->where('url', 'https://edge.qiwi.com')->first();
    }

    public function testBasicTest()
    {

    }

    public function test_dsaa_test()
    {
        $response = $this->bank()->api()->getCards('40802810900002468390');
        dd($response->json());
    }
}
