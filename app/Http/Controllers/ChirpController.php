<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Models\Chirp;
use App\Http\Requests\StoreChirpRequest;
use App\Http\Requests\UpdateChirpRequest;
use Illuminate\View\View;


class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // To collect all the chirps
        $chirps = Chirp::with('user')->latest()->get();

        return view('chirps.index', compact(['chirps',]));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created chirp resource.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(StoreChirpRequest $request)
    {
        // Validates the content sent by the user, whilst only the message is stored in
        // the validated variable
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        // --- Array based ---
        // $validated = $request->validate([
        // 'message' => ['required', 'string', 'max:255',],
        // ]);

        // Creates a chirp and associates it with the logged in user
        $request->user()->chirps()->create($validated);
        // Redirects the browser to the chirps page
        return redirect(route('chirps.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChirpRequest $request, Chirp $chirp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        //
    }
}
