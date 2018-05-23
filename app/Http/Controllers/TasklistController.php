<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Tasklist;

class TasklistController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasklists = $user->tasklists()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'tasklists' => $tasklists,
            ];
            $data += $this->counts($user);
            return view('tasklists.index', $data);
        }else {
            return view('welcome');
        }
    }
    
     public function show($id)
    {
        $user = \Auth::user();
        $tasklists = Tasklist::find($id);
        $data = [
                'user' => $user,
                'tasklists' => $tasklists,
            ];
        return view('tasklists.show', [
            'tasklists' => $tasklists,
        ]);
    }
    
    public function create()
    {
        $tasklist = new Tasklist;

        return view('tasklists.create', [
            'tasklist' => $tasklist,
        ]);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:191',
        ]);
        
        $request->user()->tasklists()->create([
            'content' => $request->content,
        ]);

        return redirect('/');
    }
    
    public function edit($id)
    {
        $tasklists = Tasklist::find($id);

        return view('tasklists.edit', [
            'tasklists' => $tasklists,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required|max:191',
            'content' => 'required|max:191',
        ]);
        
        $tasklist = Tasklist::find($id);
        $tasklist->status = $request->status;
        $tasklist->content = $request->content;
        $tasklist->save();

        return redirect('/');
    }
    
    public function destroy($id)
    {
        $tasklist = \App\Tasklist::find($id);
        
        if (\Auth::user()->id === $tasklist->user_id) {
            $tasklist->delete();
        }

        return redirect()->back();
    }
}