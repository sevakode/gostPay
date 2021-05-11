<?php

namespace App\Http\Controllers;

use App\Interfaces\OptionsPermissions;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChartsController extends Controller
{
    /**
     * Charts --------------------------------------------------------------------------------------
     * @param Request $request
     */
    public function area(Request $request)
    {
        $charts[] = $this->getAreaPayments($request);
        $charts[] = $this->getAreaProjects($request);

        return new JsonResponse($charts, 200);
    }

    public function getAreaPayments(Request $request)
    {
        $data = [
            'title' => 'chart-payments',
            'amounts' => 0
        ];
        $user = $request->user();
        $company = $user->company;

        $i = 0;

        $data['count'] = 0;
        foreach ($company->users()->withPermissionInvisible()->get() as $user) {
            if($user->hasPermission(OptionsPermissions::ACCESS_TO_INVISIBLE['slug'])) continue;

            $cards = $user->cards();

            $this->filterDate($cards, $request->date_start, $request->date_end);

            $data['users'][$i] = $user->fullName;

            $data['amount'][$i] = 0;
            foreach ($cards->get() as $card) {
                $data['amount'][$i] += $card->amountExpenditure();
                $data['amounts'] += $card->amountExpenditure();
            }

            $i++;

            $data['count'] = $cards->count();
        }
        $data['amounts'] = $company->getCurrencySign() . $data['amounts'];

        $data['colors'][] = '#1BC5BD';
        $data['colors'][] = '#C9F7F5';

        return $data;
    }

    public function getAreaProjects(Request $request)
    {
        $data = [
            'title' => 'chart-projects',
        ];
        $user = $request->user();
        $company = $user->company;

        $i = 0;
        foreach ($company->projects()->get() as $project) {
            $cards = $project->cards();

            $this->filterDate($cards, $request->date_start, $request->date_end);

            $data['users'][$i] = $project->name;

            $data['amount'][$i] = 0;
            foreach ($cards->get() as $card) {
                $data['amount'][$i] += $card->amountExpenditure();
            }
            $i++;
        }

        $data['count'] = $company->projects()->count();
        $data['colors'][] = '#ff8c00';
        $data['colors'][] = '#ffd19a';

        return $data;
    }

    public function filterDate(&$cards, $dateStart, $dateEnd)
    {
        if ($dateStart and $dateEnd) {
            $dateStart = Carbon::createFromFormat('m#d#Y', $dateStart)
                ->setTime(0, 0, 0);
            $dateEnd = Carbon::createFromFormat('m#d#Y', $dateEnd)
                ->setTime(0, 0, 0);

            $dateEnd = $dateStart->getTimestamp() == $dateEnd->getTimestamp() ? $dateEnd->addDay() : $dateEnd;

            $cards = $cards->whereHas('payments', function (Builder $query) use ($dateStart, $dateEnd) {
                $query->where('operationAt', '>=', $dateStart);
                $query->where('operationAt', '<=', $dateEnd);
            });
        }
    }
}
