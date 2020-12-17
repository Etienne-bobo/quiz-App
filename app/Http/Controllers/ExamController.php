<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Question;
use App\Models\Result;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = (new Quiz)->getAssignQuiz()->get();
        return Inertia::render('Exam/Index', [
            'quizzes' => $quizzes              
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quizzes = Quiz::latest()->get();
        $users = User::where('is_admin', '0')->latest()->get();
        return Inertia::render('Exam/Assign', ['quizzes' => $quizzes, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quiz = (new Quiz)->assignExam($request->all());
        return Redirect::route('exam.index')->with('message', 'Success Quiz assigned...');
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $quizId = $request->get('quiz_id') ;
        $userId = $request->get('user_id') ;
        $quiz = Quiz::find($quizId);
        $result = Result::where('quiz_id', $quizId)->where('user_id', $userId)->exists();
        if($result){
            return redirect()->back()->with('message', 'This quiz is played by user so it cannot remove ....');
        }else{
            $quiz->users()->detach($userId);
            return redirect()->back()->with('message', 'This quiz is now not assign to user ....');
        }
    }

    public function getQuizQuestions(Request $request, $quizId)
    {
        $authUser = auth()->user()->id;
        $quiz = Quiz::find($quizId);
        $time = Quiz::where('id', $quizId)->value('minutes');
        $quizQuestions = Question::where('quiz_id', $quizId)->with('answers')->get();
        $authUserHasPlayedQuiz = Result::where(['user_id' => $authUser, 'quiz_id' => $quizId])->get();
        return Inertia::render('Home/Quiz', [
            'quiz' => $quiz, 
            'quizQuestions' => $quizQuestions,
            'authUserHasPlayedQuiz' => $authUserHasPlayedQuiz,
            'time' => $time
            ]);
    }
}
