<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function createStudent() {
        return view('admin.users.createStudent');
    }

    public function createManager() {
        return view('admin.users.createManager');
    }

    public function createAdmin() {
        return view('admin.users.createAdmin');
    }

    public function storeStudent(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telephone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'school' => ['required', 'string', 'max:255'],
            'educationLevel' => ['required', 'string', Rule::in(['L1', 'L2', 'L3', 'M1', 'M2', 'D'])],
            'city' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => Hash::make($request->password),
        ]);
        $user->student()->create([
            'school' => $request->school,
            'education_level' => $request->educationLevel,
            'city' => $request->city,
        ]);

        event(new Registered($user));

        return redirect()->route('admin.users.index')->with('success', 'Admin créé avec succès !');
    }

    public function storeManager(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telephone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'activation_start' => ['required', 'string', 'max:255'],

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => Hash::make($request->password),
        ]);
        $user->manager()->create([
            'company' => $request->company,
            'activation_start' => $request->activation_start,
            'activation_end' => $request->activation_end,
        ]);

        event(new Registered($user));

        return redirect()->route('admin.users.index')->with('success', 'Gestionnaire créé avec succès !');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telephone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        return redirect()->route('admin.users.index')->with('success', 'Admin créé avec succès !');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'telephone' => 'required',
            'school' => 'required_if:role,student',
            'education_level' => 'required_if:role,student',
            'city' => 'required_if:role,student',
            'company' => 'required_if:role,manager',
        ]);

        $user = User::findOrFail($id);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->telephone = $validatedData['telephone'];

        // Vérifier le rôle de l'utilisateur
        if ($user->hasRole('student')) {
            // Vérifier si l'utilisateur a une relation "student" définie
            if ($user->student) {
                $user->student->school = $validatedData['school'];
                $user->student->education_level = $validatedData['education_level'];
                $user->student->city = $validatedData['city'];
                $user->student->save();
            }
        }

        if ($user->hasRole('manager')) {
            // Vérifier si l'utilisateur a une relation "manager" définie
            if ($user->manager) {
                $user->manager->company = $validatedData['company'];
                $user->manager->save();
            }
        }

        $user->save();
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès !');
        } else{
            return redirect()->route('dashboard')->with('success', 'Utilisateur mis à jour avec succès !');
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès !');
    }
    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function manager()
    {
        return $this->hasOne(Manager::class);
    }

}
