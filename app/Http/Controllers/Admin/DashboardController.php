<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
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

    public function test()
    {
        $user = Auth::user();
        return view('admin.test', compact('user'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $user = Auth::user();
        // dd($user);
        // dd($user->getRoleNames(), $user->roles, $user->permissions, $user->getPermissionsViaRoles(), $user->getAllPermissions());

        return view('admin.dashboard');
    }

    public function dashboardCountsData()
    {
        $data = DashboardService::adminDataCounts();
        return response()->json([
            'status' => 1,
            'message' => 'Dashboard Data Get Successfully ',
            'data' => $data
        ]);
    }
}
