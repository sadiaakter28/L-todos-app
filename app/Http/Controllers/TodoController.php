<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
        ]);
        $todo = new Task();
        $todo -> title = $request->title;
        $todo -> is_checked = $request->is_checked;
        $todo->save();
        return response()->json($todo);
//        return redirect()->back();
    }

    public function index() {
        $todos = Task::all();
        return response()->json($todos);
    }
    public function edit($id)
    {
        $todo = Task::find($id);
        return response()->json($todo);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $todo = Task::find($id);
        $todo -> title = $request->title;
        $todo -> is_checked = $request->is_checked;
        $todo->save();
        return response()->json($todo);
    }
}
