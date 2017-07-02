<!DOCTYPE html>
<html lang="en">
    <head>

        @include('partials._head')

    </head>
    <body>


        @include('partials._nav')

            {{--start the main container.. first one--}}

            <div class="container">

                @yield('content')
                <hr>
                @include('partials._footer')

            </div>

            {{--end of the container--}}
        @include('partials._scripts')

        @yield('scripts')
    </body>
</html>