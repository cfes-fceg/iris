<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ImportDataRequest;
use App\Imports\SessionsImport;
use App\Imports\SNLImport;
use App\Imports\UsersImport;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.index');
    }

    public function import()
    {
        return \view('admin.import');
    }

    public function do_import(ImportDataRequest $request)
    {
        if (!empty($request->hasFile('users'))) {
            Excel::import(new UsersImport, $request->file('users'));
        }

        if (!empty($request->hasFile('sessions'))) {
            Excel::import(new SessionsImport, $request->file('sessions'));
        }

        if (!empty($request->hasFile('snl'))) {
            Excel::import(new SNLImport, $request->file('snl'));
        }

        return view('admin.import')->with(['success' => true]);
    }

}
