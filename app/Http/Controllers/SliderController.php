<?php

namespace App\Http\Controllers;

use App\Models\OrganizationProfile;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Slider';
        $profile = OrganizationProfile::first();
        $slider = Slider::all();
        return view('slider.index', compact('slider', 'title', 'profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Slider';
        $profile = OrganizationProfile::first();
        return view('slider.create', compact('title', 'profile'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'link' => 'nullable|string',
            'image' => 'required|image',
        ]);

        $path = $request->file('image')->store('sliders', 'public');

        Slider::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'image' => $path,
            'link' => $request->link,
            'active' => $request->has('active'),
        ]);

        return redirect()->route('slider.index')->with('success', 'Slider created.');
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
    public function edit(Slider $slider)
    {
        $title = 'Edit Slider';
        $profile = OrganizationProfile::first();
        return view('slider.edit', compact('slider', 'title', 'profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'link' => 'nullable|string',
            'image' => 'nullable|image',
        ]);

        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('sliders', 'public');
        }

        $slider->update($data);

        return redirect()->route('slider.index')->with('success', 'Slider updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        // 1. Hapus gambar dari penyimpanan (jika ada)
        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }

        // 2. Hapus data slider dari database
        $slider->delete();

        // 3. Redirect kembali ke index dengan pesan sukses
        return redirect()->route('slider.index')->with('success', 'Slider deleted.');
    }

    public function toggleStatus(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $slider->active = $request->input('active') ? 1 : 0;
        $slider->save();

        return response()->json(['success' => true]);
    }
}