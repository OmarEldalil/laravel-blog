@extends('main')

@section('title', '| Register')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Login
                </div>
                <div class="panel-body">
                    @include('partials.messages')
                    {!! Form::open() !!}
                        <div class="form-group">
                            {{Form::label('email', 'E-mail: ')}}
                            {{Form::email('email', null , ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('password', 'Password')}}
                            {{Form::password('password', ['class'=> 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::checkbox('remember')}}{{Form::label('remember', 'Remember Me')}}
                        </div>
                    <a href="{{route('password.request') }}"><p>Forgot your Password?!</p></a>
                    <a href="{{route('register') }}"><p>Doesn't have an account?!</p></a>
                    <div class="form-group text-center">
                            {{Form::submit('Login',  ['class'=> 'btn btn-primary btn-lg'])}}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@endsection
