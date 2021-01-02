<?php

namespace App\Http\Controllers;

use App\Http\Requests\Session\StoreRequest;
use App\Models\Session;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        return view('admin.session.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('admin.session.form')->with(["session" => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        Session::create($request->validated());
        return \response()->redirectToRoute('admin.sessions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Session $session
     * @return Application|Factory|View|Response
     */
    public function edit(Session $session)
    {
        return \view('admin.session.form')->with(["session" => $session]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Session $session
     * @return RedirectResponse
     */
    public function update(Request $request, Session $session)
    {
        $session->update($request->validated());
        return \response()->redirectToRoute('admin.sessions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Session $session
     * @return RedirectResponse
     */
    public function destroy(Session $session)
    {
        $session->delete();
        return \response()->redirectToRoute('admin.sessions.index');
    }
}
