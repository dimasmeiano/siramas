<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\OrganizationProfile;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $profile = OrganizationProfile::first();
        $title = 'Dashboard';
        return view('anggota.dashboard.index', compact('profile', 'title'));
    }
}
