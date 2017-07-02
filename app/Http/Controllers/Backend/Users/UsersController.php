<?php

namespace App\Http\Controllers\Backend\Users;

use App\Models\Role;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'List Users';
        $isMaster = auth()->user()->hasRole('master');

        $users = User::with('roles');

        if (! $isMaster) {
            $users->whereHas('roles',function($query){
                $query->where('slug', '!=', 'master');
            });
        }

        $users = $users->get();
//        return $users;

        return view('pages.backend.users.index', compact('title', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'New User';

        $roles = new Role;
        if (! auth()->user()->hasRole('master')) {
            $roles = $roles->where('slug', '!=', 'master');
        }
        $available_roles = $roles->lists('name', 'id')->all();

        return view('pages.backend.users.create', compact('title', 'available_roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\UserManageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\UserManageRequest $request)
    {
        // Set checkboxes that aren't checked (default value), if it's not set in the form.
        if (! $request->active) {
            $request->merge(['active' => 0]);
        }

        if (! auth()->user()->hasRole('master') && in_array(1, $request->user_roles)) {
            return back()
                ->withInput()
                ->with('error', 'You do not have permission to create a master user.');
        }

        if (! $user = User::create($request->all())) {
            return back()
                ->withInput()
                ->with('error', 'Could not create that user.');
        }

        if (! $user_roles = $request->user_roles) {
            $user_roles = [];
        }

        if (! $user->roles()->sync($user_roles)) {
            return redirect()
                ->route('admin.users.edit', $user->id)
                ->withInput()
                ->with('error', 'Could not attach the roles to the user.');
        }

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Created that user.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! $user = User::with('roles')->where('id', $id)->first()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Could not find that user.');
        }
        //return $user;

        if (! auth()->user()->hasRole('master') && $user->hasRole('master')) {
            return redirect()
                ->route('admin.users.index')
                ->withInput()
                ->with('error', 'You do not have permission to edit a master user.');
        }

        $title = 'Edit User: '.$user->name;

        $roles = new Role;
        if (! auth()->user()->hasRole('master')) {
            $roles = $roles->where('slug', '!=', 'master');
        }
        $available_roles = $roles->lists('name', 'id')->all();
        //return $available_roles;

        $selected_roles = $user->roles()->lists('id')->all();
        //return $selected_roles;

        return view('pages.backend.users.edit', compact('title', 'user', 'available_roles', 'selected_roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\UserManageRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UserManageRequest $request, $id)
    {
        if (! $user = User::find($id)) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Could not find that user.');
        }

        if (! auth()->user()->hasRole('master') && in_array(1, $request->user_roles)) {
            return back()
                ->withInput()
                ->with('error', 'You do not have permission to assign master role to a user.');
        }

        // Set checkboxes that aren't checked (default value), if it's not set in the form.
        if (! $request->active) {
            $request->merge(['active' => 0]);
        }

        // If they don't change the password, ignore the field so it doesn't change it.
        if ($request->password == '') {
            $finalRequest = $request->except('password');
        }

        if (! $user_roles = $request->user_roles) {
            $user_roles = [];
        }

        if (! $user->roles()->sync($user_roles)) {
            return back()
                ->withInput()
                ->with('error', 'Could not attach the roles to the user.');
        }

        if (! $user->update($finalRequest)) {
            return back()
                ->withInput()
                ->with('error', 'Failed to edited that user.');
        }

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Edited that user.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! $user = User::find($id)) {
            return back()
                ->with('error', 'Could not find that user.');
        }

        if ($user->id == 1) {
            return back()
                ->with('error', 'Cannot delete the Pingala user.');
        }

        if (! $user->delete()) {
            return back()
                ->with('error', 'Could not delete that user.');
        }

        return back()
            ->with('success', 'Deleted that user.');
    }
}
