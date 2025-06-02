<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marquee;
use App\Models\OrganizationProfile;

class MarqueeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = OrganizationProfile::first();
        $title = 'Teks Berjalan';
        $marquee = Marquee::first(); // hanya satu inputan
        return view('marquee.index', compact('marquee', 'title', 'profile'));
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
    public function update(Request $request)
    {
        $request->validate([
        'text' => 'required|string',
        'direction' => 'required|in:left,right',
        'speed' => 'required|integer|min:10|max:1000',
        'is_active' => 'nullable|boolean',
    ]);

    Marquee::updateOrCreate([
        'text' => $request->text,
        'direction' => $request->direction,
        'speed' => $request->speed,
        'is_active' => $request->has('is_active'),
    ]);

    return redirect()->route('marquee.index')->with('success', 'Marquee updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
