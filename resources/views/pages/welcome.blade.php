@extends('main')

@section('title', ' | Homepage')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1>Welcome to the blog!</h1>
                    <p class="lead">Thank you for visiting the blog</p>
                    <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Posts</a></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                @php($i=0)
                @foreach($posts as $post)
                    @php($i++)
                    <div class="post">
                        <h3>{{$post->title}}</h3>
                        <p>
                            <?php
                                $str=explode(' ', strip_tags($post->body));
                                $str =array_slice($str ,0, 23);
                                $out = implode(' ', $str);
                                echo $out;
                            ?>
                            {{strlen(strip_tags($post->body))>50? '....' : ''}}
                        </p>
                        <a href="{{route('blog.single',$post->slug)}}" class="btn btn-primary">Read More</a>
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



            </div>


            <div class="col-md-3 col-md-offset-1">
                <h2>sidebar</h2>
            </div>
        </div>

@endsection