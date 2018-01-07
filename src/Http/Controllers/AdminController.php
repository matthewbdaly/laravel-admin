<?php

namespace Matthewbdaly\LaravelAdmin\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = collect(config('admin.models'))
            ->sort();
        return view('admin::home', [
            'models' => $models
        ]);
    }
}
