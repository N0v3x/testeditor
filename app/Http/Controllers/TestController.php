<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Subject;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Вывод тем для создания теста
    public function showSubjects()
    {
        $subjects = Subject::orderBy('name','asc')->get();
        return view('test.create', compact('subjects'));
    }

    //Вывод тем для редактирования теста
    public function showSubject()
    {
        if(Auth::check())
        {
            $id = Auth::id();
            $subj_id = Topic::where('id_user',$id)->pluck('id_subject');

            if(count($subj_id) > 0)
            {
                $topics = Topic::where('id_user',$id)->where('id_subject',$subj_id[0])->get();
                if(count($topics) < 0)
                    $topics = Null;
                $subjects = Subject::whereIn('id',$subj_id)->get();

                return view('test.showSubjects',array('subjects'=>$subjects,'topics'=>$topics));
            }
            else
            {
                $subjects = Null;
                $topics = Null;
                return view('test.showSubjects',array('subjects'=>$subjects,'topics'=>$topics));
            }
        }
    }


}
