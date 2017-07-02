<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWordRequest;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TagsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags=Tag::all();
        return view('tags.index', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateWordRequest|Word_request|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateWordRequest $request)
    {
        $tag = new Tag();
        $tag->name = $request->name;

        $tag->save();
        Session::flash('success', 'Tag has been successfully Saved');
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag= Tag::find($id);
        $posts = $tag->posts()->get();

        return view('tags.show', compact('tag', 'posts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag= Tag::find($id);
//      if you don't want to edit the model to detach automatic use the following method detache
//        $tag->posts()->detach();
        $tag->delete();
        return redirect()->route('tags.index');

    }
}
