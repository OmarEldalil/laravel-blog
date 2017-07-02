@extends('main')

@section('title', '| Edit Post')

@section('custom_style')
    <link rel="stylesheet" href="{{asset('css/parsley.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector:'textarea',
        });
    </script>
@stop
@section('content')
    @include('partials.messages')
    <div class="row">
        <div class="col-md-8">
            {!! Form::model($post, ['route'=>['posts.update', $post->id], 'method'=>'PUT', 'data-parsley-validate'=>'', 'files'=>'true']) !!}
            <div class="form-group">
                {{Form::label("title","Title: ")}}
                {{Form::text('title', null, ["class" => 'form-control input-lg', 'required', 'maxlength'=>'255'])}}
            </div>
            <div class="form-group">
                {{Form::label("slug","Slug: ")}}
                {{Form::text('slug', null, ["class" => 'form-control input-lg', 'required','minlength'=>'5', 'maxlength'=>'255'])}}
            </div>
            <div class="form-group">
                {{Form::label("category_id","Category: ")}}
                {{Form::select('category_id',$cats,null,['class'=>'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label("body", "Body: ")}}
                {{Form::textarea('body',null, ["class" => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label("img", "Upload an Image: ")}}
                {{Form::file('img')}}
            </div>
            <div class="form-group">
                {{Form::label('tags', 'Tags: ')}}
                {{Form::select('tags[]',$tagz,null, ['class'=>'form-control select2', 'multiple'=>'multiple'] )}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <label>URL: </label>
                    <p><a href="{{url('blog/'.$post->slug)}}">{!! url('blog/'.$post->slug) !!}</a></p>
                </dl>
                <dl class="dl-horizontal">
                    <label>Created At:</label>
                    <p>{{date("j M Y g:i A" , strtotime($post->created_at))}}</p>
                </dl>
                <dl class="dl-horizontal">
                    <label>Last Update At:</label>
                    <p>{{date("j M Y g:i A" , strtotime($post->updated_at))}}</p>
                </dl>

                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="{{route('posts.show', $post->id)}}" class="btn btn-block btn-danger">Cancel</a>
                    </div>
                    <div class="col-sm-6">
                        {{Form::submit('Save Changes',['class'=>'btn btn-success btn-block'])}}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop

@section('scripts')
    <script src="{{asset('js/parsley.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script>
        $('.select2').select2();
        $('.select2').select2().val({!! json_encode($post->tags()->pluck('tag_id')->all()) !!}).trigger('change');
    </script>

@stop