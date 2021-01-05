<?php

namespace App\Http\Controllers;

use App\Http\Requests\Session\FilterRequest;
use App\Models\Session;
use Carbon\Carbon;
use PHPUnit\Framework\Constraint\Operator;

class   UserDashboardController extends Controller
{
    public function index(FilterRequest $request)
    {
        $data = $request->validated();
        $query = Session::query();

        if (key_exists('stream', $data) && $data['stream'] > 0)
            $query = $query->where('session_stream_id', $data['stream']);

        if (key_exists('date', $data) && $data['date'] != "")
            $query = $query->whereDate('start', '=', $data['date']);
        else
            $query = $query->whereDate('start', '=', Carbon::now()->format('Y-m-d'));

        $query = $query->orderBy('start', 'ASC');

        return view('user.sessions')->with(["sessions" => $query->get(), "data" => $data]);
    }

    public function discord() {
        return view('user.discord');
    }
}
