<?php

namespace App\Http\Controllers;

use App\Models\BukuTamu;
use App\Models\Inventaris;
use App\Models\OrganizationProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardKesekretariatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = OrganizationProfile::first();
        $title = 'Dashboard Kesekretariatan';

        // Statistik tamu
        $totalTamuHariIni = BukuTamu::whereDate('created_at', Carbon::today())->count();
        $totalTamuBulanIni = BukuTamu::whereMonth('created_at', Carbon::now()->month)->count();
        $totalTamu = BukuTamu::count();

        // Statistik inventaris
        $totalBarang = Inventaris::count();
        $barangRusak = Inventaris::where('status', 'Rusak')->count();
        $barangDipinjam = Inventaris::where('status', 'Dipinjam')->count();
        $barangHilang = Inventaris::where('status', 'Hilang')->count();
        
        return view('admin.kesekretariatan.index', compact('profile', 'title', 
        'totalTamuHariIni', 'totalTamuBulanIni', 'totalTamu', 'totalBarang', 
        'barangRusak', 'barangDipinjam', 'barangHilang'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
