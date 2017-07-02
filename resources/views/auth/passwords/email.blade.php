@extends('main')

@section('title', '| Forgot My Password')

@section('content')
    @include('partials.messages')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Reset Password
                </div>
                <div class="panel-body">
                    {!! Form::open(['route'=> 'password.email']) !!}
                    <div class="form-group">
                        {{Form::label('email','E-mail: ')}}
                        {{Form::email('email', null, ['class'=>'form-control'])}}
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