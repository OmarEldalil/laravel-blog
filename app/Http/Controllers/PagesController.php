<?php

namespace App\Http\Controllers ;

use App\Mail\ContactMail;
use App\Post;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller {

    public function __construct()
    {
        $this->middleware('auth', ['only'=>'getIndex']);
    }
    public function getIndex () {
        $posts= Post::orderBy('created_at','desc')->take(5)->get();
        return view("pages.welcome")->with('posts', $posts);
    }
    public function getAbout () {
        return view("pages.about");
    }
    public function getContact () {
        return view("pages.contact");
    }

    public function postContact(Request $request)
    {
        $this->validate($request, [
            'email'=> 'required|email|',
            'subject'=> 'required|max:255',
            'message'=> 'required|min:10'
        ]);
        $data =[
            'email'=>$request->email,
            'subject'=>$request->subject,
            'bodyMessage'=> $request->message
        ];

        Mail::to('omar.eldaleel@gmail.com')->send(new ContactMail($data));
        /*
            Mail::send('emails.contact',$data,function($message)use($data){
                $message->from($data['email']);
                $message->to('omar.eldaleel@gmail.com');
                $message->subject($data['subject']);
                $message->cc('elpop_omar@gmail.com');
            });
        */
        Session::flash('success', 'Thank You For Contacting Us, We Will Get Back To You Soon');
        return redirect('/contact')->with('success', 'Thank You For Contacting Us, We Will Get Back To You Soon');
    }
}