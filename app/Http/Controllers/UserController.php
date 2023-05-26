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

    public function create()
    {
        return view('admin.users.create');
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'name' => 'required',
    //         'firstName' => 'required',
    //         'email' => 'required|email|unique:users,email',
    //         'telephone' => 'required',
    //         'address' => 'required',
    //         'password' => 'required|min:6|confirmed',
    //     ]);

    //     $user = new User;
    //     $user->name = $validatedData['name'];
    //     $user->firstName = $validatedData['firstName'];
    //     $user->email = $validatedData['email'];
    //     $user->telephone = $validatedData['telephone'];
    //     $user->address = $validatedData['address'];
    //     $user->password = bcrypt($validatedData['password']);
    //     $user->save();

    //     return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès !');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telephone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Créer l'utilisateur commun à tous les profils
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $userType = $request->type;

        // Traiter les différents types d'utilisateurs
        if ($userType === 'etudiant') {
            // Valider et enregistrer les données spécifiques aux étudiants
            $request->validate([
                'studentNumber' => ['required', 'string', 'max:255'],
                'studyCity' => ['required', 'string', 'max:255'],
                'school' => ['required', 'string', 'max:255'],
                'option' => ['required', 'string', Rule::in(['Mathématiques', 'Informatique', 'Design'])],
                'niveauEtude' => ['required', 'string', Rule::in(['L1', 'L2', 'L3', 'M1', 'M2', 'Doctorat'])],
            ]);

            $user->student()->create([
                'student_number' => $request->studentNumber,
                'study_city' => $request->studyCity,
                'school' => $request->school,
                'option' => $request->option,
                'education_level' => $request->niveauEtude,
            ]);

        } elseif ($userType === 'gestionnaire') {
            // Valider et enregistrer les données spécifiques aux gestionnaires
            $request->validate([
                'company' => ['required', 'string', 'max:255'],
            ]);

            $user->manager()->create([
                'company' => $request->company,
            ]);
        } else {
            throw new \Exception("qqqqqqqq");
        }

        event(new Registered($user));

        return redirect()->route('admin.users.store')->with('success', 'Admin créé avec succès !');
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

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès !');
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