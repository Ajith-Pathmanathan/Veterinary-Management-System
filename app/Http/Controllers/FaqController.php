<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    // Display a listing of the FAQs
    public function index()
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $faqs = Faq::all();
        return view('layouts.faqs.index', compact('faqs'));
    }

    public function create()
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        return view('layouts.faqs.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        Faq::create($request->all());

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ created successfully.');
    }

    public function edit(Faq $faq)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        return view('layouts.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq->update($request->all());

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $faq->delete();

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ deleted successfully.');
    }
}

