<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Activity;
use App\Models\Blog;
use App\Models\Recruitation;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data['total_admin'] = User::count();
        $data['total_blog'] = Blog::count();
        $data['total_recruitation'] = Recruitation::whereYear('created_at', '2024')->count();
        $data['total_achievement'] = Achievement::count();
        $data['total_event'] = Activity::count();
        $data['recruitations'] = Recruitation::whereYear('created_at', '2024')->get()->take(10);
        $data['recruitation_accepteds'] = Recruitation::whereYear('created_at', '2024')->whereIsAccepted(true)->get()->take(10);
        $data['recruitation_declineds'] = Recruitation::whereYear('created_at', '2024')->whereIsAccepted(false)->get()->take(10);

        return view('admin.dashboard.index', $data);
    }
}
