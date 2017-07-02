<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CommentController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        $this->validate($request,[
            'name'=>'required|max:255',
            'email'=> 'required|email|max:255',
            'comment'=>'required',
        ]);

        $comment = new Comment();

        $comment->name= $request->name;
        $comment->email=$request->email;
        $comment->comment=$request->comment;
        $comment->approved= true;
        $comment->post_id= $post_id;

        $comment->save();

        Session::flash('success', 'Comment was added');
        return redirect(URL::previous());
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Comment $comment
     */
    public function edit($id)
    {
        $comment= Comment::find($id);
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param $post_id
     * @internal param Comment $comment
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'comment'=>'required',
        ]);
        $comment = Comment::find($id);
        $comment->comment=$request->comment;
        $comment->save();

        Session::flash('success', 'Comment was Changed');
        return redirect()->route('posts.show', $comment->post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Comment $comment
     */
    public function destroy($id)
    {
        $comment= Comment::find($id);
        $comment->delete();

        Session::flash('success', 'Comment was Deleted');

        return redirect(URL::previous());
    }
}
