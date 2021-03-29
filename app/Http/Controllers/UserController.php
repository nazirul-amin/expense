<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('User/Index', [
            'users' => User::orderBy('created_at')->paginate(10),
        ]);
    }

    public function create()
    {
        return Inertia::render('User/Create');
    }

    public function store(Request $request)
    {
        FacadesRequest::validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $request->session()->flash('flash.banner', 'User Created');
        $request->session()->flash('flash.bannerStyle', 'success');
        return Redirect::route('users.create');
    }

    public function edit(User $user)
    {
        return Inertia::render('User/Edit', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $request->session()->flash('flash.banner', 'User updated');
        $request->session()->flash('flash.bannerStyle', 'success');
        return Redirect::back();
    }

    public function destroy(User $user, Request $request)
    {
        $user->delete();

        $request->session()->flash('flash.banner', 'User deleted');
        $request->session()->flash('flash.bannerStyle', 'success');

        return Redirect::route('users');
    }
}
