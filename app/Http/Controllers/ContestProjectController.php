<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Contest;
use App\Models\Project;
use App\Models\Manager;

use Illuminate\Http\Request;

class ContestProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('is:admin')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Contest $contest)
    {

        $managers = Manager::all();
        return view('contests.projects.index', [
            'projects' => $contest->projects,
            'contest' => $contest,
            'managers' => $managers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Contest $contest)
    {
        return view('contests.projects.create', ['projects' => $contest->projects, 'contest' => $contest]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request, Contest $contest)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $projet = Project::create([
            'contest_id' => $contest->id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('projects.show', ['project' => $projet->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('contests.projects.show', [
            'project' => $project,
            'contest' => $project->contest
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('contests.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Contest $contest, Project $project)
    {
        $project->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('projects.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return back();
    }

    public function assignManager(Request $request, Project $project)
    {
        $selectedManager = $request->input('manager-choice');

        $manager = Manager::whereHas('user', function ($query) use ($selectedManager) {
            $query->where('name', $selectedManager);
        })->first();
        if ($manager && !$project->managers->contains($manager)) {
            $project->managers()->attach($manager->user->id);
        }

        return redirect()->back();
    }

    public function podium(Project $project)
    {
        $teams = $project->teams;
        return view('contests.projects.podium', compact('teams'));
    }
}
