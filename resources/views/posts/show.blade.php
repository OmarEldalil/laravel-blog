@extends('main')

@section('title', 'View Post')

@section('content')
    <div class="row">
        @include('partials.messages')
        <div class="col-md-8">
            <h1>{{$post->title}}</h1>
            <p>{!! $post->body !!}</p>
            <img src="{{asset('imgs/posts-imgs/'.$post->img)}}" style="max-width: 400px; max-height: 400px" alt="">
            <hr>
            <div class="tags">
                @foreach($post->tags as $tag)
                    <a href="{{route('tags.show', $tag->id)}}"><span class="label label-default">{{$tag->name}}</span></a>
                @endforeach
            </div>
            <br>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Comments</h3>
                </div>
                <div class="panel-body">
                    @php($i=0)
                    @php($x=count($post->comments))

                    @if($x==0)
                        <h4>There is no comments for this post</h4>
                    @else
                        @foreach($post->comments as $comment)
                            @php($i++)
                            <p><strong>Name: </strong>{{$comment->name}}</p>
                            <p><strong>Comment: </strong>{{$comment->comment}}</p>
                            <a href="{{route('comments.edit', $comment->id)}}"><span class="glyphicon glyphicon-pencil"></span></a>
                            {{Form::open(['route'=>['comments.destroy', $comment->id],'id'=>'form-del', 'style'=>'display:inline', 'method'=>'delete'])}}
                                {{--{{Form::submit('',['class'=> 'glyphicon glyphicon-edit'])}}--}}
                                <a href="" onclick="submit(event)"><span class="glyphicon glyphicon-trash"></span></a>
                            {{Form::close()}}
                        <?php
                            if($i == $x){}
                            else{
                            ?>
                            <hr />
                            <?php
                            }
                            ?>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <label>URL: </label>
                    <p><a href="{{url('blog/'.$post->slug)}}">{!! url('blog/'.$post->slug) !!}</a></p>
                </dl>
                <dl class="dl-horizontal">
                    <label>Category: </label>
                    @php($ter=isset($post->category->id)? $post->category->id : '')
                    @if($ter == '')
                        <p> No Category</p>
                    @else
                        <p><a href="{{route('categories.show', $ter)}}">{{isset($post->category->name)? $post->category->name : 'No Category'}}</a></p>
                    @endif
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
                        <a href="{{route('posts.edit', $post->id)}}" class="btn btn-block btn-primary">Edit</a>
                    </div>
                    <div class="col-sm-6">
                        {!! Form::open(['route'=>['posts.destroy', $post->id], 'method'=>'DELETE']) !!}
                            {{Form::submit('Delete', ['class'=> 'btn btn-block btn-danger delete-btn'])}}
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('posts.index')}}" class="btn btn-default btn-block btn-h1-spacing"><< See All Posts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/slide_up_messages.js')}}"></script>
    <script src="{{asset('js/deleteScript.js')}}"></script>
    <script>
        function submit(event){

            var reply=confirm("Are you sure you want to delete this?");
            if(reply == 1){
                event.preventDefault();
                $('#form-del').submit();
            }else{
                event.preventDefault();
            }
        }
    </script>
@endsection