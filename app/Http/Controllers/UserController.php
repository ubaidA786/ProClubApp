<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use App\Models\User;
use App\Http\Helpers\FunctionHelpers;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Type\Time;

class UserController extends Controller
{
    public function index()
    {
        $paginate = Request::only('paginate')
            ? Request::only('paginate')['paginate']
            : null;
        return Inertia::render('Users/Index', [
            'filters' => Request::all('search', 'sort_by', 'sort_direction'),
            'users' => User::filter(
                Request::only('search', 'sort_by', 'sort_direction')
            )
                ->paginate(10)
                ->withQueryString()
                ->through(
                    fn($user) => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                    ]
                ),
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store()
    {
        $form = Request::validate([
            'name' => ['required', 'max:50'],
            'email' => ['max:255', 'required', 'email', 'unique:users'],
            'password' => ['max:255', 'confirmed', 'required'],
        ]);

        $form['password'] = \Hash::make($form['password']);
        User::create($form);

        return Redirect::route('users')->with('success', 'User created.');
    }

    public function show(User $user)
    {
        return Inertia::render('Users/Show', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    public function update(User $user)
    {
        $object = User::findOrFail($user->id);
        Request::validate([
            'name' => ['required', 'max:50'],
            'email' => [
                'max:255',
                'required',
                'email',
                Rule::unique('users')->ignore($object->id),
            ],
            'password' => ['max:255', 'confirmed', 'nullable'],
        ]);

        $form = Request::only('name', 'email', 'password');

        $form['password'] = \Hash::make($form['password']);
        $user->update($form);

        return Redirect::route('users')->with('success', 'User updated.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return Redirect::route('users')->with('success', 'User deleted.');
    }

    public function restore(User $user)
    {
        $user->restore();

        return Redirect::back()->with('success', 'User restored.');
    }

    public function findUsers()
    {
        return User::select(
            \DB::raw('CONCAT(first_name," ",last_name) AS name'),
            'email',
            'id'
        )
            ->where('first_name', 'LIKE', Request::get('client') . '%')
            ->orWhere('last_name', 'LIKE', Request::get('client') . '%')
            ->get();
    }
}
