@extends('main')

@section('title', ' | Contact Us')

@section('content')
    @include('partials.messages')
            <div class="row">
                <div class="col-md-12">
                    <h1>Contact Me</h1>
                    <hr>
                    <form action="{{route('postcontact')}}" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="email" name="email">Email: </label>
                            <input type="email" id="email" name="email" placeholder="E-mail" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="subject" name="subject">Subject: </label>
                            <input type="subject" id="subject" name="subject" placeholder="Your Subject" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="message" name="message">Message: </label>
                            <textarea name="message" id="message" class="form-control" placeholder="Type your Message"></textarea>
                        </div>

                        <input type="submit" class="btn btn-success" value="Send Message" id="submit">

                    </form>
                </div>
            </div>
@endsection