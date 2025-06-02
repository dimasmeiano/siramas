<?php

namespace App\Http\Controllers;

use App\Models\OrganizationProfile;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Illuminate\Support\Carbon;

class VisitorController extends Controller
{
    public function index()
    {
        $profile = OrganizationProfile::first();
        $title = 'Pengunjung';

        $today = Visitor::whereDate('visited_at', Carbon::today())->count();
        $yesterday = Visitor::whereDate('visited_at', Carbon::yesterday())->count();
        $week = Visitor::whereBetween('visited_at', [Carbon::now()->startOfWeek(), Carbon::now()])->count();
        $month = Visitor::whereMonth('visited_at', Carbon::now()->month)->count();
        $year = Visitor::whereYear('visited_at', Carbon::now()->year)->count();
        $total = Visitor::count();
        $logs = Visitor::orderBy('visited_at', 'desc')->take(20)->get(); // contoh log terbaru

         // Untuk chart
        $todayLogs = Visitor::whereDate('visited_at', Carbon::today())
            ->selectRaw('HOUR(visited_at) as hour, COUNT(*) as total')
            ->groupBy('hour')->get();

        $yesterdayLogs = Visitor::whereDate('visited_at', Carbon::yesterday())
            ->selectRaw('HOUR(visited_at) as hour, COUNT(*) as total')
            ->groupBy('hour')->get();

        $weekLogs = Visitor::whereBetween('visited_at', [Carbon::now()->startOfWeek(), Carbon::now()])
            ->selectRaw('DATE(visited_at) as date, COUNT(*) as total')
            ->groupBy('date')->get();

        $monthLogs = Visitor::whereMonth('visited_at', Carbon::now()->month)
            ->selectRaw('DATE(visited_at) as date, COUNT(*) as total')
            ->groupBy('date')->get();

        $yearLogs = Visitor::whereYear('visited_at', Carbon::now()->year)
            ->selectRaw('MONTH(visited_at) as month, COUNT(*) as total')
            ->groupBy('month')->get();

            $totalLogs = Visitor::selectRaw('YEAR(visited_at) as year, COUNT(*) as total')
            ->groupBy('year')->get();

        return view('visitor.index', compact('today' ,'yesterday', 'week', 'month', 'year', 'total', 'logs', 'todayLogs','yesterdayLogs','weekLogs','monthLogs','yearLogs', 'totalLogs', 'title', 'profile'));
    }

    public function filter($type)
{
    switch ($type) {
        case 'today':
            $data = Visitor::whereDate('visited_at', today())->get();
            break;
        case 'yesterday':
            $data = Visitor::whereDate('visited_at', today()->subDay())->get();
            break;
        case 'week':
            $data = Visitor::whereBetween('visited_at', [now()->startOfWeek(), now()])->get();
            break;
        case 'month':
            $data = Visitor::whereMonth('visited_at', now()->month)->get();
            break;
        case 'year':
            $data = Visitor::whereYear('visited_at', now()->year)->get();
            break;
        case 'all':
        default:
            $data = Visitor::all();
            break;
    }

    return response()->json($data); // bisa juga gunakan view()->render()
}
}
