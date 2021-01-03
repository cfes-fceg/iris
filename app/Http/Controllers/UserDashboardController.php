<?php

namespace App\Http\Controllers;

use App\Http\Requests\Session\FilterRequest;
use App\Models\Session;

class UserDashboardController extends Controller
{
    public function index(FilterRequest $request)
    {

        $data = $request->validated();
        $query = Session::query();

        if (key_exists('stream', $data) && $data['stream'] > 0)
            $query = $query->where('session_stream_id', $data['stream']);


        return view('dashboard')->with(["sessions" => $query->get(), "data" => $data]);
    }
}
