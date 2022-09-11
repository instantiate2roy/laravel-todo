@extends('layouts.app')
@section('content')
    @Auth
        @if ($todo->count() > 0)
            <div class="container todoContainer">
                <div class="card">

                    <div class="card-header">
                        <div class="backBtn">
                            <a class="btn btn-primary" href="/todo?{{ $pageName }}={{ $lastPage }}"><i
                                    class="fa fa-arrow-left" aria-hidden="true"> Go Back</i>
                            </a>
                        </div>
                        @if ($authorizedToUpdate)
                            <div class="editTodoBtn">
                                <a class="btn btn-secondary"
                                    href="/todo/{{ $todo->id }}/edit?{{ $lastPageName }}={{ $lastPage }}"><i class="fa
                                    fa-pencil" aria-hidden="true"> Edit</i> </a>
                            </div>
                        @endif
                        <div class="cardTitle">{{ $todo->title }}</div>

                    </div>
                    <div class="card-body">
                        <div class="col">
                            <div class="row">
                                <h1>{{ $todo->title }}</h1>
                            </div>
                            <br>
                            <div class="row">
                                <strong>Description</strong>
                                <br>
                                <p>{!! $todo->description !!}</p>
                                <br>
                                <code>{{ $todo->TimeRemaining }}</code>
                            </div>
                            <br>
                            <div class="row">
                                <div>
                                    <div>created at: <small>{{ date('d M Y  H:i A ', strtotime($todo->due_date)) }}</small>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div>
                            @if ($authorizedToDelete)
                                {!! Form::open([
                                    'action' => ['App\Http\Controllers\ToDoController@destroy', $todo->id],
                                    'method' => 'POST',
                                    'onsubmit' => 'return doSubmit(event, "postDeleteForm",' . json_encode($confirmDeleteMsg) . ')',
                                    'id' => 'postDeleteForm',
                                ]) !!}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::hidden($lastPageName, $lastPage) }}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger deleteTodoBtn']) }}
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>



                </div>
            </div>
        @endif
    @endAuth
@endsection
