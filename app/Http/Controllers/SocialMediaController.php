<?php

namespace App\Http\Controllers;

use App\Models\OrganizationProfile;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = OrganizationProfile::first();
        $title = 'Sosial Media';
        $items = SocialMedia::all();
        return view('social_media.index', compact('items', 'title', 'profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profile = OrganizationProfile::first();
        $title = 'Sosial Media';
        $items = SocialMedia::all();
        return view('social_media.create', compact('items', 'title', 'profile'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required|url',
            'icon' => 'nullable|string'
        ]);

        SocialMedia::create($request->all());
        return redirect()->route('sosial-media.index')->with('success', 'Link media sosial ditambahkan.');
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
        $profile = OrganizationProfile::first();
        $title = 'Sosial Media';
        $items = SocialMedia::findOrfail($id);
        return view('social_media.edit', compact('items', 'title', 'profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $items = SocialMedia::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'url' => 'required|url',
            'icon' => 'nullable|string',
        ]);

        $items->update($request->all());
        return redirect()->route('sosial-media.index')->with('success', 'Berhasil mengubah media sosial.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $items = SocialMedia::findOrFail($id);
        $items->delete();
        return redirect()->route('sosial-media.index')->with('success', 'Berhasil menghapus media sosial.');
    }
}
