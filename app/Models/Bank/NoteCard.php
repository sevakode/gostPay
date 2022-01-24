<?php

namespace App\Models\Bank;

use App\Casts\Json;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property integer $user_id
 * @property integer $card_id
 * @property array $message
 */
class NoteCard extends Model
{
    use HasFactory;

    protected $casts = [
        'message' => 'array',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function card()
    {
        return $this->hasOne(Card::class, 'id', 'card_id');
    }
}
