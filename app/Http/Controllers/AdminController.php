<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class AdminController extends Controller
{
    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        // Valider les données du formulaire
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
        ]);

        // Créer un nouvel administrateur
        $admin = new Admin;
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->password = bcrypt($request->input('password'));
        $admin->save();

        // Rediriger vers une page de succès ou faire d'autres actions
        return redirect()->route('admin.create')->with('success', 'Administrateur créé avec succès !');
    }
}
