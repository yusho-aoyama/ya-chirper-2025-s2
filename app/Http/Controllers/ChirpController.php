<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Models\Chirp;
use Illuminate\View\View;
// Added the following after changing the update method
use Illuminate\Http\Request;
// Adding Gates
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Builder;


class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        $chirps = Chirp::with('userVotes')
            ->withCount([
                'votes as likesCount'
                => fn (Builder $query)
                => $query->where('vote', '>', 0)], 'vote')
            ->withCount([
                'votes as dislikesCount'
                => fn (Builder $query)
                => $query->where('vote', '<', 0)], 'vote')
            ->latest()
            ->paginate();

        // return view('chirps.index', compact(['chirps',]));
        return view('chirps.index')
            ->with('chirps', $chirps);
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
    public function store(Request $request)
    {
        // more info of the validations: https://laravel.com/docs/12.x/validation

        // Validates the content sent by the user, whilst only the message is stored in
        // the validated variable
        $validated = $request->validate([
            'message' => 'required|string|max:255|min:5',
            'email' => 'required|email',
        ]);

//         --- Array based ---
//        $validated = $request->validate([
//            'message' => [
//                'required',
//                'string',
//                'max:255',
//                'min:5',
//            ],
//            'email' => [
//                'required',
//                'email',
//            ]
//        ]);

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
     *
     * This method uses Route-Model Binding
     * The resourceful route definition means we use the edit method.
     * If we wrote the route (in routes/web.php) by hand then it would be: route::get("chirps/{chirp}/edit", [ChirpController::class, 'edit'])->name('chirps.edit')
     * The Chirp $chirp automatically calls "Eloquent" to find the Model (Chirp) that was requested
     * The {chirp} is used as the "id" for Eloquent to perform the equivalent to: $chirp = Chirp::whereID($chirp)->get()
     *
     *
     */
    public function edit(Chirp $chirp)
    {
        Gate::authorize('update', $chirp);
        // return view('chirps.edit', compact(['chirp',]);

        // In the guide, the code is like the above, but it doesn't work properly and shows
        // an error, so I use the following code instead of it.

        return view('chirps.edit')
            ->with('chirp', $chirp);

//        PHP’s built-in compact function
//        compact('chirp') creates an array with the variable name 'chirp' as the key and its value.
//        return view('chirps.edit', compact((['chirp']) );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp): RedirectResponse
    {
        Gate::authorize('update', $chirp);

        $validated = $request->validate([
            'message' => [
                'required',
                'string',
                'min:5',
                'max:255',
            ],
        ]);

        $chirp->update($validated);

        return redirect(route('chirps.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        Gate::authorize('delete', $chirp);

        $chirp->delete();
        return redirect(route('chirps.index'));
    }
}
