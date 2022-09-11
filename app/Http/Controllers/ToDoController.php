<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ToDoRequest;
use Illuminate\Support\Facades\Gate;

class ToDoController extends Controller
{

    private $paginationPageName = 'todoPage';
    private $paginationLastPageName = 'todoLastPage';
    private $confirmDeleteMsg = 'Are you sure you want to delete this Task?';

    function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::where('userid', auth()->user()->id)
            ->orderByDesc('created_at')
            ->paginate($perPage = 2, $columns = ['*'], $pageName = $this->paginationPageName);

        $confirmDeleteMsg = $this->confirmDeleteMsg;

        $lastPageName = $this->paginationLastPageName;

        return view('todo.index', compact('todos', 'confirmDeleteMsg', 'lastPageName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ToDoRequest $request)
    {
        //
        $todo = new Todo();
        $todo->title = $request->input('title');
        $todo->description = $request->input('description');
        $todo->userid = auth()->user()->id;
        $todo->due_date = $request->input('due_date');

        $todo->save();
        return redirect('/todo')->with('success', 'New To Do task Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $todo = Todo::find($id);
        $confirmDeleteMsg = $this->confirmDeleteMsg;

        $pageName = $this->paginationPageName;
        $lastPageName = $this->paginationLastPageName;
        $lastPage = $request->query($this->paginationLastPageName);

        $authorizedToUpdate = Gate::allows('update', $todo);
        $authorizedToDelete = Gate::allows('delete', $todo);

        return view('todo.show', compact('todo', 'confirmDeleteMsg', 'lastPage', 'lastPageName', 'pageName', 'authorizedToDelete', 'authorizedToUpdate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //

        $todo = Todo::find($id);
        if (!$todo) {
            return redirect('/todo')->with('error', 'Can not edit Missing task!');
        }

        $response = Gate::inspect('update', $todo);
        if (!$response->allowed()) {
            return redirect('/todo/' . $todo->id)->with('error', $response->message());
        }

        $lastPageName = $this->paginationLastPageName;
        $lastPage = $request->query($this->paginationLastPageName);

        return view('todo.edit', compact('todo', 'lastPageName', 'lastPage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ToDoRequest $request, $id)
    {
        //
        $todo = Todo::find($id);
        if (!$todo) {
            return redirect('/todo')->with('error', 'Can not edit Missing task!');
        }

        $todo->title = $request->input('title');
        $todo->description = $request->input('description');
        $todo->userid = auth()->user()->id;
        $todo->due_date = $request->input('due_date');

        $lastPage = $request->input($this->paginationLastPageName);

        $todo->save();
        return redirect('/todo/' . $id . '?' . $this->paginationLastPageName . '=' . $lastPage)->with('success', 'Task Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $todo = Todo::find($id);
        if (!$todo) {
            redirect('/todo')->with('error', 'Task doesn\'t exist!');
        }
        $lastPage = $request->input($this->paginationLastPageName);
        $todo->delete();
        return redirect('/todo?' . $this->paginationPageName . '=' . $lastPage)->with('Success', 'Task deleted!');
    }
}
