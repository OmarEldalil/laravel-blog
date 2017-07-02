@extends('main')

@section('title', '| Edit Comment')

@section('content')
    @include('partials.messages')
    <div class="row"></div>
        <div class="col-md-8 col-md-offset-2">
            <h1>Edit Comment</h1>

            {{Form::model($comment, ['route'=>['comments.update',$comment->id],'method'=>'put', 'class'=>'form-group'])}}
            <div class="form-group">
                {{Form::label('name', 'Name: ')}}
                {{Form::text('name', null, ['class'=>'form-control', 'readonly'])}}
            </div>
            <div class="form-group">
                {{Form::label('email', 'Email: ')}}
                {{Form::text('email', null, ['class'=>'form-control', 'readonly'])}}
            </div>
            <div class="form-group">
                {{Form::label('comment', 'Comment: ')}}
                {{Form::textarea('comment',null, ['class'=>'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::submit('Save Changes', ['class'=>'btn btn-success btn-lg'])}}
            </div>
            {{Form::close()}}
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{asset('js/slide_up_messages.js')}}"></script>
@stop
