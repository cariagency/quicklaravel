<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\UserForm;

class UserController extends Controller {

    public function index() {
        return view('backend.users.index', [
            'users' => User::orderBy('name')->get()
        ]);
    }

    public function create() {
        $user = new User();

        $user->type = 'user';

        return view('backend.users.form', [
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

    public function store(UserForm $request) {
        $data = $request->all();
        $data['password'] = Hash::make(uniqid());

        User::create($data);

        return redirect()->route('users.index')->with('success', "User created successfully. The user must follow reset password process to set his credential.");
    }

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

        return view('backend.users.form', [
            'user' => $user,
            'form_options' => $form_options
        ]);
    }

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

    public function destroy(User $user) {
        if ($user->id === $this->user->id) {
            return redirect()->route('users.index')->with('danger', "You can't delete your own account.");
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', "User deleted successfully.");
    }

}
