@extends('main')

@section('title', '| Forgot My Password')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Reset Password
                </div>
                <div class="panel-body">
                    @include('partials.messages')
                    {!! Form::open(['url'=> 'password/reset']) !!}
                    {{Form::hidden('token', $token)}}
                    <div class="form-group">
                        {{Form::label('password', 'New Password: ')}}
                        {{Form::password('password', ['class'=>'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('password_confirmation', 'Confirm New Password: ')}}
                        {{Form::password('password_confirmation', ['class'=>'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::submit('Reset Password', ['class'=>'btn btn-primary'])}}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection