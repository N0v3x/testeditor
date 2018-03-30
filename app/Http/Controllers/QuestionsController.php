<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;
use App\Subject;
use App\Topic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Вывод всех вопростов по заданной теме
    protected function showQuestions($id)
    {
        $topic = Topic::where('id',$id)->first();
        $questions = Question::where('id_topic',$topic->id)->get();
        return view('test.showQuestions',array('questions'=>$questions,'topic'=>$topic));
    }

    //Удалить вопрос
    protected function deleteQuestion($id)
    {
        $answer = Answer::where('id_question',$id)->pluck('id');
        Question::where('id',$id)->delete();
        if(count($answer)>0)
            Answer::whereIn('id',$answer)->delete();
        return response()->json('success');
    }

    //Добавить вопрос
    protected function addQuestion(Request $request, $id)
    {
        if($request->question)
        {
            $question = new Question();
            $question->question = $request->question;
            $question->id_topic = $id;
            $question->mark= $request->mark;
            $question->save();
            $rights = $request->rightAnswer;
            foreach ($rights as $right)
            {
                $answer_r = new Answer();
                $answer_r->name = $right;
                $answer_r->correct = true;
                $answer_r->id_question = $question->id;
                $answer_r->save();
            }

            if($request->fakeAnswer)
            {
                $fakes = $request->fakeAnswer;
                foreach ($fakes as $fake)
                {
                    $answer_f = new Answer();
                    $answer_f->name = $fake;
                    $answer_f->id_question = $question->id;
                    $answer_f->save();
                }
            }
        }
        $topic = Topic::where('id',$id)->first();
        return view('test.questions', compact('topic'));
    }
     protected function getQuestion($id_topic, $id_question)
     {
         $question = Question::where('id',$id_question)->first();
         $right = Answer::where('id_question',$id_question)->where('correct',1)->get();
         $fake = Answer::where('id_question',$id_question)->where('correct',0)->get();
         return view('test.qEdit',array('right'=>$right,'fake'=>$fake,'question'=>$question,'id'=>$id_topic));
     }

     protected function editQuestion(Request $request, $id)
     {
         $question = Question::where('id',$id)->first();
         $question->question = $request->question;
         //$question->id_topic = $request->topic;
         $question->mark= $request->mark;
         $question->save();
         Answer::where('id_question',$id)->delete();
         $rights = $request->rightAnswer;
         foreach ($rights as $right)
         {
             $answer_r = new Answer();
             $answer_r->name = $right;
             $answer_r->correct = true;
             $answer_r->id_question = $question->id;
             $answer_r->save();
         }
         if($request->fakeAnswer)
         {
             $fakes = $request->fakeAnswer;
             foreach ($fakes as $fake)
             {
                 $answer_f = new Answer();
                 $answer_f->name = $fake;
                 $answer_f->id_question = $question->id;
                 $answer_f->save();
             }
         }
         $url = '/test/edit/show/questions/'.$request->topic;
         return Redirect::to($url);
     }
}
