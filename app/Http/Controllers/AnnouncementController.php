<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $announcements = Announcement::all();
        return view('layouts.announcements.index', compact('announcements'));
    }

    public function create()
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        return view('layouts.announcements.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'description'  => 'required|string|max:1000',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // 2MB max
            'expiry_date'  => 'required|date|after:today', // optional: check future date
        ], [
            'description.required' => 'Description is required.',
            'image.image'          => 'The file must be an image.',
            'image.mimes'          => 'Only jpeg, png, jpg, gif, or webp images are allowed.',
            'image.max'            => 'Image size should not exceed 2MB.',
            'expiry_date.required' => 'Expiry date is required.',
            'expiry_date.date'     => 'Expiry date must be a valid date.',
            'expiry_date.after'    => 'Expiry date must be in the future.',
        ]);


        $imagePath = $request->file('image') ? $request->file('image')->store('announcements') : null;

        Announcement::create([
            'description' => $request->description,
            'image' => $imagePath,
            'expiry_date' => $request->expiry_date,
        ]);

        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully.');
    }

    public function show(Announcement $announcement)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        return view('layouts.announcements.show', compact('announcement'));
    }

    public function edit(Announcement $announcement)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        return view('layouts.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'description'  => 'required|string|max:1000',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // 2MB max
            'expiry_date'  => 'required|date|after:today', // optional: check future date
        ], [
            'description.required' => 'Description is required.',
            'image.image'          => 'The file must be an image.',
            'image.mimes'          => 'Only jpeg, png, jpg, gif, or webp images are allowed.',
            'image.max'            => 'Image size should not exceed 2MB.',
            'expiry_date.required' => 'Expiry date is required.',
            'expiry_date.date'     => 'Expiry date must be a valid date.',
            'expiry_date.after'    => 'Expiry date must be in the future.',
        ]);


        if ($request->file('image')) {
            if ($announcement->image) {
                Storage::delete($announcement->image);
            }
            $announcement->image = $request->file('image')->store('announcements');
        }

        $announcement->update([
            'description' => $request->description,
            'image' => $announcement->image,
            'expiry_date' => $request->expiry_date,
        ]);

        return redirect()->route('announcements.index')->with('success', 'Announcement updated successfully.');
    }

    public function destroy(Announcement $announcement)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        if ($announcement->image) {
            Storage::delete($announcement->image);
        }
        $announcement->delete();

        return redirect()->route('announcements.index')->with('success', 'Announcement deleted successfully.');
    }
}
