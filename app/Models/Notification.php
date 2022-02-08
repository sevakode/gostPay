<?php

namespace App\Models;

use App\Models\Bank\Card;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $dates = [
        'read_at'
    ];

    public function card(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Card::class, 'id', 'notifiable_id');
    }

    public function id()
    {
        return $this->attributes['id'];
    }

}
