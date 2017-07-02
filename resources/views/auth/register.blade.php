@extends('main')

@section('title', '| Login')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('partials.messages')
            {!! Form::open() !!}
                <div class="form-group">
                    {{Form::label('name', 'Name: ')}}
                    {{Form::text('name', null , ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('email', 'E-mail: ')}}
                    {{Form::email('email', null , ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('password', 'Password')}}
                    {{Form::password('password', ['class'=> 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('password_confirmation', 'Confirm Your Password')}}
                    {{Form::password('password_confirmation', ['class'=> 'form-control'])}}
                </div>
                <div class="form-group text-center">
                    {{Form::submit('Register',  ['class'=> 'btn btn-primary btn-lg'])}}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
