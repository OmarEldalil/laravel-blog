@extends('main')

@section('title', "| $tag->name Posts")

@section('content')
    <div class="row">
        <div class="col-md-10">
            <h1>{{ucwords($tag->name)}} Tag Posts</h1>
        </div>
        <div class="col-md-2">
            {{Form::open(['route'=>['tags.destroy', $tag->id], 'method'=>'DELETE'])}}
                {{Form::submit('Delete', ['class'=>'btn btn-danger btn-block btn-h1-spacing delete-btn'])}}
            {{Form::close()}}
        </div>
    </div>

    <hr>

    <table class="table table-responsive">

        <thead>
        <tr>
            <th>
                #
            </th>
            <th>
                Title
            </th>
            <th>
                Body
            </th>
            <th>
                Created At
            </th>
            <th>

            </th>
        </tr>
        </thead>
        <tbody>
        @if($posts->count() == 0)
            <tr>
                <td colspan="5" class="text-center"><h2>There Is No Posts For Right Now</h2></td>
            </tr>
        @else
            @php ($i=1)
            @foreach($posts as $post)

                <tr>
                    <td>
                        {{$i}}
                    </td>
                    <td>
                        {{$post->title}}
                    </td>
                    <td>
                        <?php
                        $str=explode(' ', strip_tags($post->body));
                        $str =array_slice($str ,0, 10);
                        $out = implode(' ', $str);
                        echo $out;
                        ?>
                        {{strlen(strip_tags($post->body))>50? '....' : ''}}
                    </td>
                    <td>
                        {{date('M d,Y',strtotime($post->created_at))}}
                    </td>
                    <td>
                        <a href="{{route('posts.show', $post->id)}}" class="btn btn-primary btn-sm">View</a>
                        <a href="{{route('posts.edit', $post->id)}}" class="btn btn-info btn-sm">Edit</a>

                        {!! Form::open(['route'=>['posts.destroy', $post->id], 'method'=>'DELETE' , 'style' => 'display:inline']) !!}
                        {{Form::submit('Delete', ['class'=> 'btn btn-danger btn-sm delete-btn'])}}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @php ($i++)
            @endforeach
        @endif
        </tbody>
    </table>

@endsection

@section('scripts')
    <script src="{{asset('js/deleteScript.js')}}"></script>
@stop