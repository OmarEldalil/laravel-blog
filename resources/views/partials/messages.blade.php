@if(Session::has('success'))
    <div class="alert alert-success" role="alert">

        @if(Session::has('important'))
            <button type="button" class="closeMessage" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        @endif
        <strong>Success</strong> {{Session::get('success')}}

    </div>
@endif


@if(count($errors)>0)

    <div class="alert alert-danger @yield('errorInCreate')" role="alert">
        <strong>Error:</strong>
        <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
        </ul>
    </div>
@endif

@if(Session::has('status'))
    <div class="alert alert-success" role="alert">

        <strong>Success</strong> {{Session::get('status')}}

    </div>
@endif