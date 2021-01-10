<?php

namespace Database\Seeders;

use App\Models\Bank\Card;
use App\Models\Company;
use App\Models\Role;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @var Role $ownerRole
     * @return void
     */
    public function run()
    {
        Card::refreshApi();

        $cards = array();
        foreach (Card::all() as $card) {
            $card->company_id = Company::first()->id;
            $card->save();
//            $cards[] = $card;
        }
//        Card::upsert($cards);
//        dd(Card::all()->pluck('head'), Card::all()->pluck('tail'));
    }
}
