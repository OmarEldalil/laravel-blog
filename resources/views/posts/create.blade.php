@extends('main')

@section('title' , '| Create New Post')

@section('custom_style')
    {{--<link rel="stylesheet" href="{{asset('css/parsley.css')}}">--}}

    {{--or you can use the below form--}}

    {!! Html::style('css/parsley.css') !!}
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">


@endsection

@section('errorInCreate', 'col-sm-12 col-md-8 col-md-offset-2')

@section('content')

    <div class="row">
        @include('partials.messages')
        <div class="col-sm-12 col-md-8 col-md-offset-2">
            <h1>Create New Post</h1>
            <hr>
            {!! Form::open(['route' => 'posts.store', 'data-parsley-validate'=>'', 'files'=>'true']) !!}
            <div class="form-group">
                {{Form::label('title', 'Title: ')}}
                {{Form::text('title', null ,array('class' => 'form-control', 'required'=>'', 'maxlength'=>'255'))}}
            </div>
            <div class="form-group">
                {{Form::label('slug', 'Slug: ')}}
                {{Form::text('slug', null ,array('class' => 'form-control', 'required'=>'',"minlength"=>"5", 'maxlength'=>'255'))}}
            </div>

            <div class="form-group">
                {{Form::label('category_id', 'Category: ')}}
                <select name="category_id" id="category_id" class="form-control">
                    <option value=""></option>
                    @foreach($cats as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                {{Form::label('body' , 'Post Content: ')}}
                {{Form::textarea('body',null, array('class' => 'form-control'))}}
            </div>

            <div class="form-group">
                {{Form::label('tags', 'Tags: ')}}
                <select name="tags[]" class="form-control select2" multiple="multiple">
                    <option value=""></option>
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                {{Form::label('img', 'Upload An Image: ')}}
                {{Form::file('img')}}
            </div>

            <div class="form-group"></div>

                {{Form::submit('Create Post', array('class' => 'btn btn-success btn-lg', 'style' => 'margin: 10px 41%;'))}}
            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
    <script src="{{asset('js/parsley.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script>
        $('.select2').select2();
    </script>

@endsection