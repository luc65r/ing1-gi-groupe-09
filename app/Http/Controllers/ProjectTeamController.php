<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Http\Requests\SubmitTeamRequest;
use App\Models\Team;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        return view('contests.projects.teams.index', ['teams' => $project->teams, 'project' => $project]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        return view('contests.projects.teams.create', ['teams' => $project->teams, 'project' => $project]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTeamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeamRequest $request, Project $project)
    {
        $request->validate([
            'name' => ['required', 'string'],
        ]);

        $student = auth()->user()->student;

        //if ($student) {
        $team = Team::create([
            'project_id' => $project->id,
            'name' => $request->name,
            'owner' => $student->user_id,
        ]);
        $student->teams()->attach($team);

        //}
        return redirect()->route('teams.show', ['team' => $team]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        return view('contests.projects.teams.show', ['team' => $team]);
    }

    public function join(Team $team)
    {
        $user = Auth::user();

        $user->student->teams()->attach($team->id);

        return redirect()->route('teams.show', ['team' => $team]);
    }

    public function quit(Team $team)
    {
        $user = Auth::user();

        $user->student->teams()->detach($team->id);
        if ($team->owner === $user->id)
            return $this->destroy($team);

        return redirect()->route('teams.show', ['team' => $team]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTeamRequest  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()->route('dashboard');
    }

    public function submit(SubmitTeamRequest $request, Team $team)
    {
        $request->validate([
            'code' => ['required', 'url', 'max:255'],
        ]);

        $team->update([
            'code' => $request->code,
        ]);

        return redirect()->route('teams.show', compact('team'));
    }
}
