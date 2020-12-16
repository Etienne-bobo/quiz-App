<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Answer;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::latest()->get();
        return Inertia::render('Quiz/Index', ['quizzes' => $quizzes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Quiz/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         Quiz::create([
             'name' => $request->get('name'),
             'description' => $request->get('description'),
             'minutes' => $request->get('minutes')
         ]);
         return Redirect::route('quiz.index')->with('message', 'Success Quiz created...');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        return Inertia::render('Quiz/Edit', [
            'quiz' => [
                'id' => $quiz->id,
                'name' => $quiz->name,
                'description' => $quiz->description,
                'minutes' => $quiz->minutes,
                'questions' => $quiz->questions()->get()->map->only('id', 'question'),
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $quiz = Quiz::find($id);
        $quiz-> name = $request->get('name');
        $quiz-> description = $request->get('description');
        $quiz-> minutes = $request->get('minutes');
        $quiz->save();
        return redirect()->back()->with('message', 'Success Quiz updated ....');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        (new Answer)->deleteAnswer($id);
        (new Question)->deleteQuestion($id);
        $quiz = Quiz::find($id);
        $quiz->delete();
        return Redirect::route('quiz.index')->with('message', 'Success Quiz deleted ....');
    }
}
