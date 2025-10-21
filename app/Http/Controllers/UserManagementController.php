<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
// Add use lines
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'search' => ['nullable', 'string',]
        ]);
        $search = $validated['search'] ?? '';

        $users = User::whereAny(
            ['name', 'email','position',], 'LIKE', "%$search%")
            ->paginate(10); // This tells Laravel to have 10 users on each page

        return view('admin.users.index')
            ->with('users', $users)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /// TODO: Update when we add Roles & Permissions
        $roles = Collection::empty();
        return view('admin.users.create', compact(['roles',]));
    }

    /**
     * Store a newly created resource in storage
     *
     * validate the data
     * create a new user
     * return to the users index page
     * .
     */
    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'name'=>['required','min:2', 'max:192',],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
    //            'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'password' => ['required', 'confirmed', Password::defaults()],
                'role'=>['nullable',],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => mb_strtolower($request->email),
                'password' => Hash::make($request->password),
            ]);

            $userName = $user->name;

    //        flash()
    //            ->option('position', 'top-center')
    //            ->option('timeout', 5000)
    //            ->success("User $userName created successfully!",[],"User Added");

            flash()->success("User $userName created successfully!",
                [
                    'position' => 'top-center',
                    'timeout' => 5000,
                ],
                "User Added");

            return redirect(route('users.index'));
        } catch (ValidationException $e) {

            flash()->error(
                'Please fix the errors in the form.',
                [
                    'position' => 'top-center',
                    'timeout' => 5000,
                ],
                'User Creation Failed'
            );

            // バリデーションエラーをフォームに返す
            return back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * The method expects the user details to be given to it... the user that will be edited
     * The view call puts the roles and the user data into the packet that is sent to the view.
     *
     */
    public function show(User $user)
    {
        // resources/views/users/show.blade.php
        return view('admin.users.show', compact(['user']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // TODO: Update when we add Roles & Permissions
        $roles = Collection::empty();

        return view('admin.users.edit', compact(['roles', 'user',]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            // the method should not change from the default that was created by the artisan command.
            $validated = $request->validate([
                'name' => ['required', 'min:2', 'max:192',],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class)->ignore($user),
                ],
                'password' => [
                    'sometimes',
                    'nullable',
                    'confirmed',
//                Rules\Password::defaults()
                    Password::defaults()
                ],
                'role' => ['nullable',],
            ]);

            // Remove password if null
            // check to see if the validated password is null, and if so remove the array key so it does not violate the "required" and "not null" data requirements in the model.
            if (is_null($validated['password'])) {
                unset($validated['password']);
            }

            // To tell Laravel to fill the changed fields with the validated data
            $user->fill($validated);

            // Checks to see if the email has changed...
            // "is the data dirty": If it is then we force the user to verify the new email address...
            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            // To set we save the updated user data
            $user->save();

            // Notify User to Verify New Email
            //        if (is_null($user->email_verified_at)) {
            //            $user->sendEmailVerificationNotification();
            //        }

            $userName = $user->name;

            flash()->success("User $userName edited successfully!",
                [
                    'position' => 'top-center',
                    'timeout' => 5000,
                ],
                "User Added");

            // Redirect back to the user index view
            return redirect(route('users.index'));

        } catch (\Illuminate\Validation\ValidationException $e) {

            flash()->error(
                'Please fix the errors in the form.',
                ['position' => 'top-center', 'timeout' => 5000],
                'User Update Failed'
            );

            return back()->withErrors($e->validator)->withInput();
        }

    }

    /**
     * Confirm the delete action
     *
     */
    public function delete(User $user)
    {
        // Authentication
        //

        return view('admin.users.delete', compact(['user']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $userName = $user->name; // 名前を保存しておく
            $user->delete();

            flash()->success(
                "User $userName deleted successfully!",
                ['position' => 'top-center', 'timeout' => 5000],
                "User Deleted"
            );

            return redirect(route('users.index'));

        } catch (\Exception $e) {
            flash()->error(
                'Failed to delete user.',
                ['position' => 'top-center', 'timeout' => 5000],
                'Deletion Failed'
            );

            return back();
        }
    }
}
