<?php namespace Warkensoft\Laradmin\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('laradmin::dashboard');
    }
}
