<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Team;
use App\Models\Quiz;
use App\Http\Requests\StoreAnswerRequest;

use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function show(Quiz $quiz, Team $team)
    {
        $answers = $team->answers()->whereHas('question', function ($query) use ($quiz) {
            $query->where('quiz_id', $quiz->id);
        })->get()->mapWithKeys(function ($answer, $key) {
            return [$answer->question_id => $answer->answer];
        });

        return view('answers.show', compact('team', 'quiz', 'answers'));
    }

    public function store(StoreAnswerRequest $request, Quiz $quiz, Team $team)
    {

        foreach ($request->input('reponses') as $questionId => $response) {
            Answer::create([
                'question_id' => $questionId,
                'team_id' => $team->id,
                'answer' => $response,
            ]);
        }
        return redirect()->route('quizzes.show', ['quiz' => $quiz->id, 'team' => $team]);
    }
}
