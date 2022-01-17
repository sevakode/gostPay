<?php

namespace Tests\Feature;

use App\Models\Bank\BankToken;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class QiwiTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @return BankToken
     */
    public function bank(): BankToken
    {
        return BankToken::query()->where('url', 'https://business.tinkoff.ru')->first();
        return BankToken::query()->where('url', 'https://edge.qiwi.com')->first();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_info_test()
    {
        $response = $this->bank()->api()->getAccountInfo();
        dd($response->collect());
    }

    public function test_balance_list_test()
    {
        dd($this->bank()->invoices()->get());
        $personId = $this->bank()->api()->getAccountInfo()->object()->personId;
        $response = $this->bank()->api()->getBalancesList($personId);
    }

    public function test_dsaa_test()
    {
        $response = $this->bank()->api()->getStatement('40802810100002227700');
        $response = $this->bank()->api()->initStatement('40802810100002227700', now()->subMonth()->format('Y-m-d'), now()->format('Y-m-d'))
            ;
        dd($response->collect('operation')->sortByDesc('id'), $response);
        dd($response->collect('cards')->where('cardLastFourDigits', 6066));
    }
}
