<?php

namespace App\Http\Controllers;

use App\Http\Requests\Session\FilterRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Session;
use Carbon\Carbon;
use Request;
use function DeepCopy\deep_copy;

class   UserDashboardController extends Controller
{
    public function index(FilterRequest $request)
    {
        $query = Session::query();

        $date = null;

        if ($request->has('stream') && $request->get('stream') != "")
            $query = $query->where('session_stream_id', $request->get('stream'));

        if ($request->has('date') && $request->get('date') != "")
            $date = Carbon::createFromFormat('Y-m-d', $request->get('date'), 'America/Toronto');
        else
            $date = Carbon::now('America/Toronto');

        $query = $query->whereDate('start', '=', $date->format('Y-m-d'));

        $query = $query->orderBy('start', 'ASC');

        $prevParams = $request->query->all();
        $prevParams['date'] = $date->subDay()->format('Y-m-d');

        $nextParams = $request->query->all();
        $nextParams['date'] = $date->addDays(2)->format('Y-m-d');

        return view('user.sessions')->with(
            [
                "sessions" => $query->get(),
                "data" => $request->validated(),
                "links" => [
                    "prev" => route('sessions', $prevParams),
                    "next" => route('sessions', $nextParams)
                ]
            ]
        );
    }

    public function updateAccount(UpdateRequest $request) {
        $request->user()->update($request->validated());
        return redirect()->route('account');
    }

    public function account() {
        return view('user.account', ["user" => \Auth::user()]);
    }

    public function discord()
    {
        return view('user.discord');
    }
}
