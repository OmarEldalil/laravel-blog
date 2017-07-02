<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreateWordRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;

class CategoriesController extends Controller
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
        $cats= Category::paginate(10);

        return view('categories.index', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateWordRequest|CreateWordRequest|Word_request|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateWordRequest $request)
    {
        $cat= new Category();
        $cat->name=$request->name;
        $cat->save();
        Session::flash('success','New category has been created');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat=Category::find($id);
        $posts= Post::where('category_id', '=',$id)->paginate(10);
        return view('categories.show', compact('cat','posts'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat= Category::find($id);
        $cat->delete();
        return redirect()->route('categories.index');
    }
}
