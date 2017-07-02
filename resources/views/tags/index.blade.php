@extends('main')

@section('title', '| All Tags')

@section('content')
    <div class="row">
        @include('partials.messages')
        <div class="col-md-5">
            <h1>All Tags</h1>
        </div>

        <div class="col-md-7">
            <button type="button" class="pull-right btn btn-primary btn-lg btn-h1-spacing" data-toggle="modal" data-target="#edit">Create New Tag</button>
            <div class="modal fade" id="edit" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Create Tag</h4>
                        </div>
                        <div class="modal-body">

                            {{Form::open(['route'=>'tags.store', 'class'=>'form-inline'])}}
                            {{Form::label('name', 'Name: ')}}
                            {{Form::text('name', null, ['class'=>'form-control'])}}
                            {{Form::submit('Create', ['class'=>'btn btn-primary'])}}
                            {{Form::close()}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>

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
                name
            </th>
            <th>
                Created At
            </th>
            <th>

            </th>
        </tr>
        </thead>
        <tbody>
        @if($tags->count() == 0)
            <tr>
                <td colspan="5" class="text-center"><h2>There Is No Tags For Right Now</h2></td>
            </tr>
        @else
            @foreach($tags as $tag)
                <tr>
                    <td>
                        {{$tag->id}}
                    </td>
                    <td>
                        {{$tag->name}}
                    </td>
                    <td>
                        {{date('M d,Y',strtotime($tag->created_at))}}
                    </td>
                    <td>
                        <a href="{{route('tags.show', $tag->id)}}" class="btn btn-default btn-sm">View Related Posts</a>
                        {!! Form::open(['route'=>['tags.destroy', $tag->id], 'method'=>'DELETE' , 'style' => 'display:inline']) !!}
                        {{Form::submit('Delete', ['class'=> 'btn btn-danger btn-sm delete-btn'])}}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@endsection

@section('scripts')
    <script src="{{asset('js/slide_up_messages.js')}}"></script>
    <script src="{{asset('js/deleteScript.js')}}"></script>
@stop