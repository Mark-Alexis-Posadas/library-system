<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::first();

        if (!$settings) {
            $settings = Setting::create([
                'library_name' => 'Pangasinan Public Library',
                'address' => 'Lingayen, Pangasinan',
                'phone' => '075 123 4567',
                'email' => 'library@example.com',
                'max_books' => 3,
                'borrow_days' => 7,
                'fine_per_day' => 10,
            ]);
        }

        return view('pages.settings.index', compact('settings'));
    }

    public function updateLibrary(Request $request)
    {
        $validated = $request->validate([
            'library_name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:1000'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
        ]);

        $settings = Setting::firstOrFail();

        $settings->update($validated);

        return redirect()
            ->route('settings.index')
            ->with('success', 'Library information updated successfully.');
    }

    public function updateBorrowing(Request $request)
    {
        $validated = $request->validate([
            'max_books' => ['required', 'integer', 'min:1', 'max:100'],
            'borrow_days' => ['required', 'integer', 'min:1', 'max:365'],
            'fine_per_day' => ['required', 'numeric', 'min:0'],
        ]);

        $settings = Setting::firstOrFail();

        $settings->update($validated);

        return redirect()
            ->route('settings.index')
            ->with('success', 'Borrowing rules updated successfully.');
    }
}
