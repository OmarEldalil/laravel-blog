<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreatePostRequest;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use App\Post;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Mockery\CountValidator\Exception;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $posts=Post::orderBy('id', 'desc')->paginate(10);
//        var_dump($posts);
//        echo $posts->first()->created_at;
//        echo "<br />";
//        echo strtotime($posts->first()->created_at);
//        die();

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags= Tag::all();
        $cats=Category::all();
        return view('posts.create', compact('cats', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePostRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
//        dd($request);
        $post = new Post();
        $post->title=$request->title;
        $post->slug= $request->slug;
        $post->body=$request->body;
        $post->category_id = $request->category_id;

        if($request->hasFile('img')){
            $image= $request->file('img');
            $fileName= time() . '.' . $image->getClientOriginalExtension();
            $location= public_path('imgs/posts-imgs/' . $fileName);
            Image::make($image)->resize(800,400)->save($location);
            $post->img= $fileName;
        }

        $post->save();

        $tags=isset($request->tags)? $request->tags : [];
        $post->tags()->sync($tags);
        Session::flash('success', 'The post has been successfully saved !');
        return redirect()->route('posts.show',['id'=>$post->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post= Post::findOrFail($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags= Tag::all();
//        $tagz= array();
        $categories=Category::all();
        $cats=[];
        $post= Post::find($id);
        foreach($categories as $cat){
            $cats[$cat->id]=$cat->name;
        }
        foreach($tags as $tag){
            $tagz[$tag->id]=$tag->name;
        }
//        dd($post->tags->first());
        return view('posts.edit')->with('post', $post)->with('cats',$cats)->with('tags', $tags)->with('tagz',$tagz);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreatePostRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $post = Post::find($id);

        if($post->slug== $request->slug){
            $this->validate($request,[
                'title' => 'required|max:255',
                'slug'=>['required', 'alpha_dash', 'min:5', 'max:255'],
                'category_id' =>'required|integer',
                'body'=> 'required'
            ]);
        }else{
            $this->validate($request,[
                'title' => 'required|max:255',
                'slug'=>['required', 'alpha_dash', 'min:5', 'max:255', Rule::unique('posts')],
                'category_id' =>'required|integer',
                'body'=> 'required'
            ]);
        }


        $post->title = $request->title;
        $post->slug=$request->slug;
        $post->body = $request->body;
        $post->category_id=$request->category_id;


        if($request->hasFile('img')){
            $image= $request->file('img');
            $fileName= time() . '.' . $image->getClientOriginalExtension();
            $location= public_path('imgs/posts-imgs/' . $fileName);
            Image::make($image)->resize(800,400)->save($location);
            Storage::delete($post->img);
            $post->img= $fileName;
        }


        $post->save();
        $tags=isset($request->tags)? $request->tags : [];
        $post->tags()->sync($tags);
        Session::flash('success', 'The post has been successfully updated !');
        return redirect()->route('posts.show',['id'=>$post->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post= Post::find($id);
//      if you don't want to edit the model to detach automatic use the following method detache
//        $post->tags()->detach();
        Storage::delete($post->img);
        $post->delete();
        Session::flash('success', 'The post was successfully deleted');

        if(preg_match('/posts/',URL::previous())){
            return redirect()->route('posts.index');
        }else{
            return Redirect::to(URL::previous());
        }

    }
}
