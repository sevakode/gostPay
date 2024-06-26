<?php namespace App\Traits;


use App\Models\Bank\Card;
use Illuminate\Database\Eloquent\Builder;
use Ramsey\Collection\Collection;

trait TableCards
{
    public function sort(&$cards, $sort)
    {
        if(!isset($sort['sort']) and count($sort['sort']) != 2) return;
        $this->sortNumber($cards, $sort);
    }

    public function getSort($data, $sort)
    {
        if(isset($sort['sort']))
        {
            $this->sortDataUsers($data, $sort);
            $this->sortDataAmount($data, $sort);
            $this->sortDataProject($data, $sort);
//            $this->sortDataUpdateAt($data, $sort);
        }

        $data = $data->values()->all();

        return $data;
    }

    public function filter(&$cards, $filter)
    {
        $this->filterSearch($cards, $filter);
        $this->filterStatus($cards, $filter);
        $this->filterUsers($cards, $filter);
    }

    public function sortNumber(&$cards, $filter)
    {

        if(in_array($filter['sort']['field'], ['number', 'issue_at'])) {
            if ($filter['sort']['sort'] == 'asc')
                $cards = $cards->orderBy($filter['sort']['field']);
            if ($filter['sort']['sort'] == 'desc')
                $cards = $cards->orderByDesc($filter['sort']['field']);
        }
    }

    public function sortUpdateAt(&$cards, $filter)
    {
        if (in_array($filter['sort']['field'], ['issue_at', 'created_at']))
            $cards = $cards->orderBy($filter['sort']['field'], $filter['sort']['sort']);
    }

    public function sortDataUpdateAt(&$data, $filter)
    {
        $sort = function ($product) {
            return $product['issue_at'];
        };

        if($filter['sort']['field'] == 'issue_at')
        {
            if($filter['sort']['sort'] == 'desc') $data = $data->sortByDesc($sort);
            if($filter['sort']['sort'] == 'asc') $data = $data->sortBy($sort);
        }
    }

    public function sortDataCountPayments(&$data, $filter)
    {
        $sort = function ($product) {
            return $product['countPayments']['cards'];
        };

        if($filter['sort']['field'] == 'countPayments')
        {
            if($filter['sort']['sort'] == 'desc') $data = $data->sortByDesc($sort);
            if($filter['sort']['sort'] == 'asc') $data = $data->sortBy($sort);
        }
    }

    public function sortDataProject(&$data, $filter)
    {
        $field = $filter['sort']['field'];
        $sort = function ($product) use($field){
            return $product[$field];
        };

        if($field == 'project')
        {
            if($filter['sort']['sort'] == 'desc') $data = $data->sortByDesc($sort);
            if($filter['sort']['sort'] == 'asc') $data = $data->sortBy($sort);
        }
    }

    public function sortDataAmount(&$data, $filter)
    {
        $field = $filter['sort']['field'];
        $sort = function ($product) use($field){
            return (float)$product[$field];
        };

        if($field == 'amount')
        {
            if($filter['sort']['sort'] == 'desc') $data = $data->sortByDesc($sort);
            if($filter['sort']['sort'] == 'asc') $data = $data->sortBy($sort);
        }
    }

    public function sortDataUsers(&$data, $filter)
    {
        $field = $filter['sort']['field'];
        $sort = function ($product) use($field){
            return $product[$field];
        };

        if($field == 'user')
        {
            if($filter['sort']['sort'] == 'desc') $data = $data->sortByDesc($sort);
            if($filter['sort']['sort'] == 'asc') $data = $data->sortBy($sort);
        }
    }

    public function filterSearch(&$cards, $filter)
    {
        if(isset($filter['query']['generalSearch']))
            $cards = $cards
                ->where('number', 'like', '%' . $filter['query']['generalSearch'] . '%')
                ->orWhere('card_type', 'like', '%' . $filter['query']['generalSearch'] . '%')
                ->orWhere('head', 'like', $filter['query']['generalSearch'] . '%')
                ->orWhere('tail', 'like', $filter['query']['generalSearch'] . '%')
                ->orWhereHas('user', function (Builder $query) use($filter){
                    $query->where('first_name', 'like', '%' . $filter['query']['generalSearch'] . '%');
                    $query->orWhere('last_name', 'like', '%' . $filter['query']['generalSearch'] . '%');
                })
                ->orWhereHas('project', function (Builder $query) use($filter){
                    $query->where('name', 'like', '%' . $filter['query']['generalSearch'] . '%');
                });
    }

    public function filterStatus(&$cards, $filter)
    {
        if (isset($filter['query']['state']))
            $cards = $cards->where('state', $filter['query']['state']);
        else if(isset($filter['query']))
            $cards = $cards->where('state', Card::ACTIVE);
    }

    public function filterUsers(&$cards, $filter)
    {
        if(isset($filter['query']['type']) and $filter['query']['type'] !== '')
            if($filter['query']['type'] !== 'null')
                $cards = $cards->where('user_id', $filter['query']['type']);
            else
                $cards = $cards->where('user_id', null);
    }
}
