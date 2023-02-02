<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_users = User::all()->count();
        $today_users = User::whereDay('created_at', now()->day)->count();
        return view('home')->with([
            'total_users' => $total_users,
            'today_users' => $today_users
        ]);
    }
}
