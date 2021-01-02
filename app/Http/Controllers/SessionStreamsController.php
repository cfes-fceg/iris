<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionStream\StoreRequest;
use App\Http\Requests\SessionStream\UpdateRequest;
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
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        SessionStream::create($request->validated());

        return \response()->redirectToRoute('admin.streams.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SessionStream $stream
     * @return Application|Factory|View|Response
     */
    public function edit(SessionStream $stream)
    {
        return view('admin.stream.form')->with(["stream" => $stream]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param SessionStream $stream
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, SessionStream $stream): RedirectResponse
    {
        $stream->update($request->validated());
        return \response()->redirectToRoute('admin.streams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SessionStream $stream
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(SessionStream $stream): RedirectResponse
    {
        $stream->delete();
        return \response()->redirectToRoute('admin.streams.index');
    }
}
