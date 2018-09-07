<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserForm;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('users.index', [
            'users' => User::orderBy('name')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = new User();

        $user->type = 'user';

        return view('users.form', [
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\UserForm  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserForm $request) {
        $data = $request->all();
        $data['password'] = Hash::make(uniqid());

        User::create($data);

        return redirect()->route('users.index')->with('success', "User created successfully. The user must follow reset password process to set his credential.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        return view('users.form', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UserForm  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserForm $request, User $user) {
        $data = array_filter($request->all());

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->fill($data);

        $user->save();

        return redirect()->route('users.index')->with('success', "User updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {
        $user->delete();

        return redirect()->route('users.index')->with('success', "User deleted successfully.");
    }

}
