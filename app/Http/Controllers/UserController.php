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
            'user' => $user,
            'form_options' => [
                'model' => $user,
                'store' => 'users.store',
                'update' => 'users.update',
                'id' => 'user-form',
                'autocomplete' => 'off'
            ]
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
    public function edit(User $user = null) {
        $form_options = [
            'id' => 'user-form',
            'autocomplete' => 'off'
        ];

        if ($user === null) {
            $user = $this->user;
            $form_options['method'] = 'PUT';
            $form_options['url'] = route('users.profile');
        } else {
            $form_options['store'] = 'users.store';
            $form_options['update'] = 'users.update';
        }

        $form_options['model'] = $user;

        return view('users.form', [
            'user' => $user,
            'form_options' => $form_options
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UserForm  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserForm $request, User $user = null) {
        $profile = ($user === null);

        if ($profile) {
            $user = $this->user;
        }

        $data = array_filter($request->all());

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->fill($data);

        $user->save();

        if ($profile) {
            return redirect()->route('home')->with('success', "Your profile was successfully updated.");
        }

        return redirect()->route('users.index')->with('success', "User updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {
        if ($user->id === $this->user->id) {
            return redirect()->route('users.index')->with('danger', "You can't delete your own account.");
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', "User deleted successfully.");
    }

}
