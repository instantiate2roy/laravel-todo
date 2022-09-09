@extends('layouts.app')
@section('content')
    @Auth
        <div class="container">
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
                                            <a href="/todo/{{ $todo->id }}">
                                                <div class='row'><strong>{{ $todo->title }}</strong></div>
                                                <div class='row'>
                                                    <code>Due:{{ date('d M Y  H:i', strtotime($todo->due_date)) }}</code>
                                                </div>
                                            </a>
                                        </div>
                                        <div class='col-md-1'>
                                            <div class='row'>
                                                <div class='col-md-6'><i class="fa fa-pencil" aria-hidden="true"></i></div>
                                                <div class='col-md-6'><i class="fa fa-close deleteBtn" aria-hidden="true"></i>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            <br>
                            {{ $todos->links() }}
                        @endif
                    </ol>
                </div>

            </div>
        </div>
    @endAuth
@endsection
