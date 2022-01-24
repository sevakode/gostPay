<?php

namespace App\Services;

use App\Models\Bank\NoteCard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;

class NotesCardService implements NotesCardDirectory
{
    protected \Illuminate\Database\Eloquent\Builder $modelQuery;
    protected Model $model;

    public function __construct()
    {
        $this->setModel(new NoteCard());
    }

    public function create($user_id, $card_id, $message)
    {
        $model = $this->getModel();
        $model->user_id = $user_id;
        $model->card_id = $card_id;
        $model->message = $message;

        return $model->save();
    }

    public function update($id, $user_id, $card_id, $message)
    {
        $model = $this->getQuery()->find($id);
        $model->user_id = $user_id;
        $model->card_id = $card_id;
        $model->message = $message;
        $model->save();

        return $model;
    }

    public function delete($id)
    {
        return $this->getQuery()->where('id', $id)->delete();
    }

    public function refreshQuery()
    {
        $this->modelQuery = $this->model::query();
    }

    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    public function getModel(): Model
    {
        return clone $this->model;
    }

    public function getQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return $this->model::query()->clone();
    }

    public function getDatatables(int $card_id): array
    {
        return $this->getQuery()->where('card_id', $card_id)->orderByDesc('id')
            ->with('user')->get()
            ->map(function (NoteCard $noteCard) {
                return [
                    'id' => $noteCard->id,
                    'user_id' => $noteCard->user_id,
                    'full_name' => $noteCard->user->fullName,
                    'created_at' => $noteCard->created_at->format('m-d-Y'),
                    'is_me' => $noteCard->user_id == Auth::id(),
                    'ops' => $noteCard->message
                ];
            })
            ->all();
    }
}
