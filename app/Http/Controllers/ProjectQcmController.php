<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQcmRequest;
use App\Http\Requests\UpdateQcmRequest;
use App\Models\Qcm;
use App\Models\Project;

class ProjectQcmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        return view('projects.qcm.index', ['qcm' => $project->qcm, 'project' => $project]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQcmRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQcmRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Qcm  $qcm
     * @return \Illuminate\Http\Response
     */
    public function show(Qcm $qcm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Qcm  $qcm
     * @return \Illuminate\Http\Response
     */
    public function edit(Qcm $qcm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQcmRequest  $request
     * @param  \App\Models\Qcm  $qcm
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQcmRequest $request, Qcm $qcm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Qcm  $qcm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Qcm $qcm)
    {
        //
    }
}
