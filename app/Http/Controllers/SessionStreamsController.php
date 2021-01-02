<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionStreamRequest;
use App\Models\SessionStream;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SessionStreamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        return view('admin.stream.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('admin.stream.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSessionStreamRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSessionStreamRequest $request)
    {
        SessionStream::create($request->validated());

        return \response()->redirectToRoute('admin.streams.index');
    }

    /**
     * Display the specified resource.
     *
     * @param SessionStream $sessionStream
     * @return Response
     */
    public function show(SessionStream $sessionStream): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SessionStream $sessionStream
     * @return Response
     */
    public function edit(SessionStream $sessionStream): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param SessionStream $sessionStream
     * @return Response
     */
    public function update(Request $request, SessionStream $sessionStream): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SessionStream $sessionStream
     * @return Response
     */
    public function destroy(SessionStream $sessionStream): Response
    {
        //
    }
}
