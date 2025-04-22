<?php

namespace App\Http\Controllers;

use App\Models\Aslab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AslabController extends Controller
{
    /**
     * Display a listing of the aslabs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aslabs = Aslab::latest()->get();
        return view('aslab.index', compact('aslabs'));
    }

    /**
     * Show the form for creating a new aslab.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('aslab.create');
    }

    /**
     * Store a newly created aslab in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'social_media' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('aslabs.create')
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/aslab_images', $imageName);
            $data['image'] = $imageName;
        }

        Aslab::create($data);

        return redirect()
            ->route('aslabs.index')
            ->with('success', 'Aslab created successfully.');
    }

    /**
     * Display the specified aslab.
     *
     * @param  \App\Models\Aslab  $aslab
     * @return \Illuminate\Http\Response
     */
    public function show(Aslab $aslab)
    {
        return view('aslab.show', compact('aslab'));
    }

    /**
     * Show the form for editing the specified aslab.
     *
     * @param  \App\Models\Aslab  $aslab
     * @return \Illuminate\Http\Response
     */
    public function edit(Aslab $aslab)
    {
        return view('aslab.edit', compact('aslab'));
    }

    /**
     * Update the specified aslab in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aslab  $aslab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aslab $aslab)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'social_media' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('aslabs.edit', $aslab->id)
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($aslab->image) {
                Storage::delete('public/aslab_images/' . $aslab->image);
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/aslab_images', $imageName);
            $data['image'] = $imageName;
        }

        $aslab->update($data);

        return redirect()
            ->route('aslabs.index')
            ->with('success', 'Aslab updated successfully.');
    }

    /**
     * Remove the specified aslab from storage.
     *
     * @param  \App\Models\Aslab  $aslab
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aslab $aslab)
    {
        // Delete image if exists
        if ($aslab->image) {
            Storage::delete('public/aslab_images/' . $aslab->image);
        }
        
        $aslab->delete();

        return redirect()
            ->route('aslabs.index')
            ->with('success', 'Aslab deleted successfully.');
    }
}