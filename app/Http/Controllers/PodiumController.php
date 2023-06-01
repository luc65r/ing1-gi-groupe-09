<?php

namespace App\Http\Controllers;

use App\Models\Podium;
use Illuminate\Http\Request;
use App\Models\Quiz;


class PodiumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $quiz = Quiz::all();
        return view('contest.projects.quizzes.podium', compact('quiz'));

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Podium  $podium
     * @return \Illuminate\Http\Response
     */
    public function show(Podium $podium)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Podium  $podium
     * @return \Illuminate\Http\Response
     */
    public function edit(Podium $podium)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Podium  $podium
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Podium $podium)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Podium  $podium
     * @return \Illuminate\Http\Response
     */
    public function destroy(Podium $podium)
    {
        //
    }
}
