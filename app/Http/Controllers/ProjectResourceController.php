<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Resource;
use Illuminate\Http\Request;

class ProjectResourceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url', 'max:255'],
        ]);

        Resource::create([
            'name' => $request->name,
            'url' => $request->url,
            'project_id' => $project->id,
        ]);

        return redirect()->route('projects.show', compact('project'));
    }
}
