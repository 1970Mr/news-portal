<?php

namespace Modules\RedirectManager\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\RedirectManager\App\Models\Redirect;

class RedirectController extends Controller
{
    public function index(): View
    {
        $redirects = Redirect::query()->latest()->paginate(10);
        return view('redirect-manager::index', compact('redirects'));
    }

    public function create(): View
    {
        return view('redirect-manager::create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'source_url' => 'required|url|unique:redirects',
            'destination_url' => 'required|url',
            'status_code' => 'required|integer',
        ]);

        Redirect::create($request->all());
        return redirect()->route('redirects.index')->with('success', 'Redirect created successfully.');
    }

    public function edit(Redirect $redirect): View
    {
        return view('redirect-manager::edit', compact('redirect'));
    }

    public function update(Request $request, Redirect $redirect): RedirectResponse
    {
        $request->validate([
            'source_url' => 'required|url|unique:redirects,source_url,' . $redirect->id,
            'destination_url' => 'required|url',
            'status_code' => 'required|integer',
        ]);

        $redirect->update($request->all());
        return redirect()->route('redirects.index')->with('success', 'Redirect updated successfully.');
    }

    public function destroy(Redirect $redirect): RedirectResponse
    {
        $redirect->delete();
        return redirect()->route('redirects.index')->with('success', 'Redirect deleted successfully.');
    }
}
