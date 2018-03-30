<?php

namespace App\Http\Controllers;


use App\Answer;
use App\Question;
use App\Subject;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Удалить тему
    protected function deleteTopic($id)
    {

        $question_id = Question::where('id_topic',$id)->pluck('id');
        if(count($question_id) > 0){
            $answer_id = Answer::where('id_question',$question_id)->pluck('id');
            Topic::where('id',$id)->delete();
            Question::whereIn('id',$question_id)->delete();
            if(count($answer_id) > 0)
            Answer::whereIn('id',$answer_id)->delete();
        }
        else
            Topic::where('id',$id)->delete();
        $data = 'success';
        return response()->json($data);
    }

    //Создать тему
    protected function createTopic(Request $request)
    {
        if(Auth::check())
        {
            $topic = new Topic;
            $sub_name = $request->get('subject');
            $id_subject = Subject::where('name',$sub_name)->value('id');
            $id_user = Auth::id();
            $topic->name = $request->get('topic');
            $topic->id_subject = $id_subject;
            $topic->id_user = $id_user;
            $topic->save();
            return view('test.questions',compact('topic'));
        }
    }

    //Вывод тем по заданному предмету
    protected function showTopics($id)
    {
        $id_user = Auth::id();
        $topics = Topic::where('id_user',$id_user)->where('id_subject',$id)->get();
        return response()->json($topics);
    }

    protected function changeTopic(Request $request, $id)
    {
        $topic = Topic::find($id);
        $topic->name = $request->topic;
        $topic->save();
        return response()->json('success');
    }

}
