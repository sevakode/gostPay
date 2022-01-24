<?php

namespace App\Services;


interface NotesCardDirectory
{
    public function getDatatables(int $card_id): array;
    public function create($user_id, $card_id, $message);
    public function update($id, $user_id, $card_id, $message);
    public function delete($id);
}
