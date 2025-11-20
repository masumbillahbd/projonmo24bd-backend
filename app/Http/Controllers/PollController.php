<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\PollAnswer;
use App\Models\PollChoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PollController extends Controller
{
    public function index()
    {
        return view('back.polls.index');
    }

    public function create()
    {
        return view('back.polls.create');
    }

    public function store(Request $request)
    {
        $poll = new Poll;
        $poll->question = $request->question;
        $poll->user_id = Auth::user()->id;
        $poll->start_date = $request->start_date;
        $poll->end_date = $request->end_date;
        $poll->save();
        $last_poll = Poll::orderBy('created_at', 'desc')->first();
        $poll_ans = new PollChoice;
        $poll_ans->poll_id = $last_poll->id;
        $poll_ans->poll_answer = 'হ্যাঁ';
        $poll_ans->save();
        $poll_ans = new PollChoice;
        $poll_ans->poll_id = $last_poll->id;
        $poll_ans->poll_answer = 'না';
        $poll_ans->save();
        $poll_ans = new PollChoice;
        $poll_ans->poll_id = $last_poll->id;
        $poll_ans->poll_answer = 'মন্তব্য নেই';
        $poll_ans->save();
        Session::flash('message', 'Successfully Added');
        $last_poll = Poll::orderBy('created_at', 'desc')->first();
        return redirect(route('poll.create'));
    }

    public function edit($id)
    {
        $pollEdit = Poll::find($id);
        return view('back.polls.edit',compact('pollEdit'));
    }

    public function update(Request $request, $id)
    {
        $poll = Poll::find($id);
        $poll->question = $request->question;
        $poll->start_date = $request->start_date;
        $poll->end_date = $request->end_date;
        $poll->save();
        Session::flash('message', 'Successfully Updated');
        return redirect(route('poll.index'));
    }

    public function destroy($id){
        $poll = Poll::find($id);
        $pollChoice = PollChoice::where('poll_id',$poll->id)->get();
        $pollAnswer = PollAnswer::where('poll_id',$poll->id)->get()->count();

        if(empty($pollAnswer)){
            foreach($pollChoice as $choice){
                $choice->delete();
            }
            $poll->delete();
            Session::flash('success', 'Successfully Deleted');
            return redirect(route('poll.index'));
        }
        Session::flash('danger',"Don't Deleted. Because poll related some other tables");
        return redirect(route('poll.index'));
    }

    public function pollChoiceStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'session_id' => 'unique:poll_answers',
        ]);
        if ($validator->fails()) {
            return Redirect::back();
        }
        $poll_choice = new PollAnswer;
        $poll_choice->session_id = $request->session_id;
        $poll_choice->poll_id = $request->poll_id;
        $poll_choice->poll_answer_id = $request->poll_choice;
        $poll_choice->save();
        return redirect(url('/'));
    }
}
