@extends('main')
@php($title=htmlEntities($post->title))
@section('title', "| $title ")

@section('content')
    @include('partials.messages')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>{{$post->title}}</h2>
            <h5>Published: {{date('M d,Y',strtotime($post->created_at))}}</h5>
            <p>{!! $post->body !!}</p>
            @if($post->img != null)
                <img src="{{asset('imgs/posts-imgs/'.$post->img)}}" style="max-width: 400px; max-height: 400px" alt="">
            @endif
            <p class="btn-h1-spacing">Category: <a href="{{route('categories.show', $post->category->id)}}" class="nounderline">{{$post->category->name}}</a></p>
            <div class="tags">
                @foreach($post->tags as $tag)
                    <a href="{{route('tags.show', $tag->id)}}"><span class="label label-default">{{$tag->name}}</span></a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3><span class="glyphicon glyphicon-comment gl-st"></span>{{$post->comments()->count()}} Comments</h3>
            @foreach($post->comments()->orderBy('created_at', 'desc')->get() as $comment)
                <div class="wrapper">
                    <div class="comment">
                        <img src="{{asset('imgs/test.png')}}" class="author-img">
                        <div class="data-wrapper">
                            <div class="author-info">
                                <div class="author-name">
                                    <h4 class="commentator">{{$comment->name}}</h4>
                                    <p class="date-created-at">{{$comment->created_at->diffForHumans()}}</p>
                                </div>
                            </div>
                            <div class="comment-content">
                                {{$comment->comment}}
                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="clearfix"></div>--}}
            @endforeach
        </div>
    </div>
    <div class="row">
        @if(!(\Illuminate\Support\Facades\Auth::check()))
                <div class="col-md-8 col-md-offset-2">
                    <h3><a href="{{route('login')}}">You need to login to leave a comment</a></h3>
                </div>
            </div>
        @else
        <div class="col-md-2">
            <h3 style="text-decoration: underline">Add Comment</h3>
        </div>

        <div class="row">
            <div id="comment-form" class="col-md-8 col-md-offset-2">
                {{Form::open(['route'=>['comments.store', $post->id], 'class'=>'form-group'])}}
                <div class="form-group">
                    {{Form::label('name', 'Name: ')}}
                    {{Form::text('name',null, ['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                {{Form::label('email', 'Email: ')}}
                {{Form::email('email',null, ['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                {{Form::label('comment', 'Comment: ')}}
                {{Form::textarea('comment',null, ['class'=>'form-control', 'rows'=>'3'])}}
                </div>
                <div class="form-group">
                    {{Form::submit('Add Comment', ['class'=>'btn btn-success btn-block'])}}
                </div>
                {{Form::close()}}
            </div>
        </div>
        @endif
@stop

@section('scripts')
    <script src="{{asset('js/slide_up_messages.js')}}"></script>
@endsection