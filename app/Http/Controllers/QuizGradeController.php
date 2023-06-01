<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Quiz;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class QuizGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, Quiz $quiz, Team $team)
    {
        $request->validate([
            'grade' => ['required', 'integer', 'between:0,4'],
            'team_id' => ['required', 'exists:teams,id', Rule::in([$team->id])],
            'quiz_id' => ['required', 'exists:quizzes,id', Rule::in([$quiz->id])],
        ]);

        Grade::create([
            'grade' => ['required', 'integer', 'between:0,4'],
            'team_id' => ['required', 'exists:teams,id', Rule::in([$team->id])],
            'quiz_id' => ['required', 'exists:quizzes,id', Rule::in([$quiz->id])],
        ]);

        return redirect()->route('quizzes.show', $quiz->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        //
    }
}
