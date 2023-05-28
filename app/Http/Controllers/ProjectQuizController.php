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
            'name' => $request->question,
            'question1' => $request->question,
            'question2' => $request->question,
            'question3' => $request->question,
            'question4' => $request->question,
            'question5' => $request->question,
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

        return redirect()->route('projects.quizzes.index', ['quizzes' => $project->quizzes, 'project' => $project]);
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
        return view('contests.projects.quizzes.edit', compact('project', 'quiz'));
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
        $request->validate([
            'name' => 'required',
            'question1' => 'required',
            'question2' => 'required',
            'question3' => 'required',
            'question4' => 'required',
            'question5' => 'required',
        ]);

        $quiz->update([
            'name' => $request->name
        ]);

        $quiz->questions()->delete();

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

        return redirect()->route('projects.quizzes.index', ['quizzes' => $project->quizzes, 'project' => $project]);
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
        $quiz->questions()->delete();
        $quiz->delete();
        return back();
    }
}
