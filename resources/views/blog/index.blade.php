@extends('main')

@section('title', '| Blog')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>Blog</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if($posts->count() == 0)
                <h2>There Is No Posts For Right Now</h2>
            @else
                @php($i=0)
                @foreach($posts as $post)
                    @php($i++)
                    <div class="post">
                        <h2>{{$post->title}}</h2>
                        <h5>Published: {{date('M d,Y',strtotime($post->created_at))}}</h5>
                        <p>
                            <?php
                            $str=explode(' ', strip_tags($post->body));
                            $str =array_slice($str ,0, 23);
                            $out = implode(' ', $str);
                            echo $out;
                            ?>
                            {{strlen(strip_tags($post->body))>50? '....' : ''}}
                        </p>
                        <a href="{{route('blog.single',$post->slug)}}" class="btn btn-primary btn-sm">Read More</a>
                    </div>
                    <?php
                        if(count($posts)== $i){

                        }else{
                            ?>
                            <hr>
                            <?php
                        }
                    ?>

                @endforeach
            @endif
        </div>

    </div>
    <div class="row" id="pag">
        <div class="col-md-12">
            <div class="text-center">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        if($('ul.pagination').length){
            $('#pag').show();
        }else{
            $('#pag').remove();
        }
    </script>
@stop