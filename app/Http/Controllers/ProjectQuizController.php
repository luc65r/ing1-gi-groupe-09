<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;

class ProjectQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        return view('contests.projects.quizzes.index', ['quizzes' => $project->quizzes, 'project' => $project]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        return view('contests.projects.quizzes.create', ['quizzes' => $project->quizzes, 'project' => $project]);
    }

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
            'name' => ['required', 'string'],
            'question1' => ['required', 'string'],
            'question2' => ['required', 'string'],
            'question3' => ['required', 'string'],
            'question4' => ['required', 'string'],
            'question5' => ['required', 'string'],
        ]);

        $quiz = Quiz::create([
            'project_id' => $project->id,
            'name' => $request->name
        ]);

        Question::create([
            'question' => $request->question1,
            'quiz_id' => $quiz->id,
        ]);
        Question::create([
            'question' => $request->question2,
            'quiz_id' => $quiz->id,
        ]);
        Question::create([
            'question' => $request->question3,
            'quiz_id' => $quiz->id,
        ]);
        Question::create([
            'question' => $request->question4,
            'quiz_id' => $quiz->id,
        ]);
        Question::create([
            'question' => $request->question5,
            'quiz_id' => $quiz->id,
        ]);

        return redirect()->route('quizzes.show', ['quiz' => $quiz]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Quiz $quiz)
    {
        return view('contests.projects.quizzes.show', ['quiz' => $quiz, 'questions' => $quiz->questions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, Quiz $quiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, Quiz $quiz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Quiz $quiz)
    {
        //
    }
}