<?php

namespace App\Http\Controllers;

use App\Http\Requests\Session\StoreRequest;
use App\Http\Requests\Session\UpdateRequest;
use App\Models\Session;
use App\Support\Zoom;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
        $session = Session::make($request->validated());
        if (
            empty($session->zoom_meeting_id) &&
            $request->get('create_meeting') == true
        ) {
            $meeting = Zoom::createMeeting(
                "CELC - CCLI 2021 | " . $session->title,
                $session->start,
                $session->start->diff($session->end),
                $session->stream->zoom_host,
            );
            $session->zoom_meeting_id = $meeting->id;
        }
        $session->save();
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
     * @param UpdateRequest $request
     * @param Session $session
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Session $session)
    {
        $session->update($request->validated());
        if (!empty($session->zoom_meeting_id)) {
            $meeting = Zoom::updateMeeting(
                $session->zoom_meeting_id,
                "CELC - CCLI 2021 | " . $session->title,
                $session->start,
                $session->start->diff($session->end),
            );
            $session->zoom_meeting_id = $meeting->id;
        }
        $session->save();

        return \response()->redirectToRoute('admin.sessions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Session $session
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Session $session)
    {
        $session->delete();
        return \response()->redirectToRoute('admin.sessions.index');
    }

    /**
     * Join the zoom meeting of the session
     *
     * @param Session $session
     * @return RedirectResponse
     */
    public function join(Session $session)
    {
        if ($session->zoom_meeting_id != null) {
            return redirect()->to(Zoom::getJoinUrl($session->zoom_meeting_id));
        } else {
            return back();
        }
    }
}
