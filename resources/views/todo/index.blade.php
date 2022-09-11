@extends('layouts.app')
@section('content')
    @Auth
        <div class="container todoContainer">
            <div class="card">
                <div class="card-header">
                    <div style="float: right;">
                        <a class="btn btn-primary" href="/todo/create"><i class="fa fa-plus" aria-hidden="true"></i> </a>
                    </div>
                    <div>My To Do List</div>

                </div>
                <div class="card-body">
                    <ol class="list-group">
                        @if ($todos->count() > 0)
                            {{ $todos->links() }}
                            <br>
                            @foreach ($todos as $todo)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class='col-md-11'>
                                            <a href="/todo/{{ $todo->id }}?todoLastPage={{ $todos->currentPage() }}">
                                                <div class='row'><strong>{{ $todo->title }}</strong></div>
                                                <div class='row'>
                                                    <code>Due:{{ $todo->TimeRemaining }}</code>
                                                </div>
                                            </a>
                                        </div>
                                        <div class='col-md-1'>
                                            {!! Form::open([
                                                'action' => ['App\Http\Controllers\ToDoController@destroy', $todo->id],
                                                'method' => 'POST',
                                                'id' => 'deleteToDo',
                                                'onSubmit' => 'return doSubmit(event, "deleteToDo",' . json_encode($confirmDeleteMsg) . ')',
                                            ]) !!}

                                            {{ Form::hidden('_method', 'DELETE') }}
                                            {{ Form::hidden($lastPageName, $todos->currentPage()) }}
                                            <button class='fa fa-close deleteXIcon' type="submit"></button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            <br>
                            {{ $todos->links() }}
                        @else
                            <div>
                                No To do items yet.
                            </div>
                        @endif
                    </ol>
                </div>

            </div>
        </div>
    @endAuth
@endsection
