@extends('layouts.app')
@section('content')
    @Auth
        <div class="container todoContainer">
            <div class='card'>
                <div class="card-header">
                    <div class="backBtn">
                        <a class="btn btn-primary" href="/todo"><i class="fa fa-arrow-left" aria-hidden="true"> Go Back</i> </a>
                    </div>
                    <div class="cardTitle"><h1><u>New To Do Item</u></h1></div>
                </div>

                <div class="card-body">
                    {!! Form::open(['method' => 'post', 'action' => 'App\Http\Controllers\ToDoController@store']) !!}
                    <div class="form-group">
                        {{ Form::label('title', 'Title') }}
                        {{ Form::text('title', '', [
                            'class' => 'form-control',
                            'placeholder' => 'Title',
                            'required'=>true
                        ]) }}
                    </div>
                    <br>
                    <div class="form-group">
                        {{ Form::label('description', 'Description') }}
                        {{ Form::textarea('description', '', [
                            'class' => 'form-control',
                            'placeholder' => 'description',
                            'id' => 'ck_editor_element'
                            
                        ]) }}
                    </div>
                    <br>
                    <div class="form-group">
                        {{ Form::label('due_date', 'Due Date') }}
                        <input class="form-control" type="datetime-local" name="due_date" required>

                    </div>
                    <br>
                    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    {!! Form::close() !!}
                </div>


            </div>
        </div>
    @endAuth
@endsection
