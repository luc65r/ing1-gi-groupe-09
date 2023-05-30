<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function searchProjects(Request $request)
    {
        $query = $request->input('query');

        $manager = Manager::find(auth()->User()->id);
        $projects = $manager->projects()->where('name', 'like', "%$query%")->get();

        return view('manager.projects.search_results', ['projects' => $projects]);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->query('search');

        $managers = Manager::where('email', 'LIKE', '%' . $searchTerm . '%')->get();

        return response()->json($managers);
    }
}
