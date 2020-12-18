<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Result;
use DB;
class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Quiz $quiz)
    {
        $authUser = auth()->user()->id;
        $assignedQuizId = [];
        $user = DB::table('quiz_user')->where('user_id', $authUser)->get();
        foreach($user as $u){
            array_push($assignedQuizId, $u->quiz_id);
        }
        $quizzes = Quiz::whereIn('id', $assignedQuizId)->get(); //compare array of id
        $isExamAssigned = DB::table('quiz_user')->where('user_id', $authUser)->exists();
        $wasQuizCompleted = Result::where('user_id', $authUser)->whereIn('quiz_id', (new Quiz)->hasQuizAttempted())->pluck('quiz_id')->toArray();   
        $questions = Quiz::with('questions')->get();
        return Inertia::render('Home/Index',[
            'quizzes' => $quizzes,
            'wasQuizCompleted' => $wasQuizCompleted,
            'isExamAssigned' => $isExamAssigned,
            'questions' =>$questions,
            'authUser' => $authUser
        ]);
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
    public function destroy($id)
    {
        //
    }
}
