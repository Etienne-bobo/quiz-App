<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Question;
use App\Models\Result;
use App\Models\Answer;

use DB;

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
        //check if user has been assigned a particular quiz
        $userId = DB::table('quiz_user')->where('user_id', $authUser)->pluck('quiz_id')->toArray();
        if(!in_array($quizId, $userId)){
            return Redirect::route('home')->with('message', 'You are not assigned this Quiz');
        }
        $quiz = Quiz::find($quizId);
        $times = Quiz::where('id', $quizId)->value('minutes');
        $quizQuestions = Question::where('quiz_id', $quizId)->with('answers')->get();
        $authUserHasPlayedQuiz = Result::where(['user_id' => $authUser, 'quiz_id' => $quizId])->get();
        //has user played particular quiz
        $wasCompleted = Result::where('user_id', $authUser)->whereIn('quiz_id', (new Quiz)->hasQuizAttempted())->pluck('quiz_id')->toArray();
        if(in_array($quizId, $wasCompleted)){
            return Redirect::route('home')->with('message', 'You have already completed this quiz..');
        }
        return Inertia::render('Home/Quiz', [
            'quiz' => $quiz, 
            'quizQuestions' => $quizQuestions,
            'authUserHasPlayedQuiz' => $authUserHasPlayedQuiz,
            'times' => $times
            ]);
    }
    
    public function postQuiz(Request $request)
    {
        $questionId = $request['questionId'];
        $answerId = $request['answerId'];
        $quizId = $request['quizId'];

        $authuser = auth()->user();
        return $userQuestionAnswer = Result::updateOrCreate(
            [
                'user_id' => $authuser->id,
                'quiz_id' => $quizId,
                'question_id' => $questionId
            ],
            ['answer_id' => $answerId]
        );
        
    }
    public function viewResult($userId, $quizId){
        $results = Result::where('user_id', $userId)->where('quiz_id', $quizId)->with('question')->with('answer')->get();
        $answers = DB::table('answers')->get();
        $ans = [];
        foreach($results as $answer){
            array_push($ans , $answer->answer->id);
        }
        $totalQuestions = Question::where('quiz_id', $quizId)->count();
        $userCorrectedAnswer = Answer::whereIn('id', $ans)->where('is_correct', 1)->count();
        return Inertia::render('Home/Result', [
            'results' => $results, 
            'answers' => $answers,
            'totalQuestions' => $totalQuestions,
            'userCorrectedAnswer' => $userCorrectedAnswer,
            ]);
    }
    
    public function result(){
        $quizzes = Quiz::with('users')->get();
        return Inertia::render('Result/Index', [
            'quizzes' => $quizzes, 
            ]);
    }
    public function userQuizResult($userId, $quizId){
        $results = Result::where('user_id', $userId)->where('quiz_id', $quizId)->with('question')->with('answer')->get();
        $totalQuestions = Question::where('quiz_id', $quizId)->count();
        $attemptQuestion = Result::where('quiz_id', $quizId)->where('user_id', $userId)->count();
        $quiz = Quiz::where('id', $quizId)->get();
        $answers = DB::table('answers')->get();
        $ans = [];
        foreach($results as $answer){
            array_push($ans , $answer->answer->id);
        }
        $userCorrectedAnswer = Answer::whereIn('id', $ans)->where('is_correct', 1)->count();
        $userWrongAnswer = $totalQuestions - $userCorrectedAnswer;
        $percentage = ($userCorrectedAnswer/$totalQuestions)*100;
        return Inertia::render('Result/ViewResult', [
            'results' => $results, 
            'totalQuestions' => $totalQuestions, 
            'attemptQuestion' => $attemptQuestion, 
            'userCorrectedAnswer' => $userCorrectedAnswer, 
            'userWrongAnswer' => $userWrongAnswer, 
            'percentage' => $percentage,
            'quiz' => $quiz,
            'answers' => $answers,
            ]);
    }

    public function statistics(){
        $totalNumberOfQuestions = DB::table('questions')->count();
        $totalNumberOfQuiz = DB::table('quizzes')->count();
        $totalNumberOfUsers = User::where('is_admin', '0')->count();
        return Inertia::render('Statistics', [
            'totalNumberOfQuestions' => $totalNumberOfQuestions, 
            'totalNumberOfQuiz' => $totalNumberOfQuiz, 
            'totalNumberOfUsers' => $totalNumberOfUsers, 
            ]);
    }

}
