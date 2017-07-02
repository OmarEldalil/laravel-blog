
{{--default nav bar--}}
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Laravel Blog</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{Request::is('/')? 'active' : ''}}"><a href="/">Home</a></li>
                <li class="{{preg_match('/blog/',Request::path())? 'active' : ''}}"><a href="/blog">blog</a></li>
                <li class="{{Request::is('about')? 'active' : ''}}"><a href="/about">About</a></li>
                <li class="{{Request::is('contact')? 'active' : ''}}"><a href="/contact">Contact</a></li>
{{--            <li class="{{preg_match('/posts/',Request::path())? 'active' : ''}}"><a href="{{route('posts.index')}}">Posts</a></li>--}}
            </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::check())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello {{ucwords(Auth::user()->name)}} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('posts.index')}}">Posts</a></li>
                                <li><a href="{{route('categories.index')}}">Categories</a></li>
                                <li><a href="{{route('tags.index')}}">Tags</a></li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    {{Form::open(['route'=> 'logout','id'=>'logout_method'])}}
                                        {{Form::submit('Logout', ['id'=>'logout_anchor'])}}
                                    {{Form::close()}}
                                </li>
                            </ul>
                        </li>
                    @else

                        @if($_SERVER['REQUEST_URI']==='/login' ||$_SERVER['REQUEST_URI']==='/register')
                            @else
                            <a href="{{route('login')}}" class="btn btn-default" style="margin-top: 8px;">Login</a>
                            <a href="{{route('register')}}" class="btn btn-primary" style="margin-top: 8px;">Register</a>
                        @endif
                </ul>
            @endif

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>