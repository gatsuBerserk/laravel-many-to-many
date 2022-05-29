<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Model\Category;
use App\Model\Post;
use App\User;

use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $posts=Post::all();
        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.posts.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|max:100|min:4",
            "content" => "required|max:250|min:10",
            "image_url" => "required",
        ]);

        $data = $request->all();
        $data["user_id"] = Auth::user()->id;
        $data["author"] = Auth::user()->name;

        $newPost = new Post(); 
        $newPost->fill($data); 
        $newPost->save();

        return redirect()->route("admin.posts.index")->with("message", "$newPost->title è stato pubblicato in bacheca");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $post= Post::findOrFail($id); 
        return view("admin.posts.show", compact("post", "user"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view("admin.posts.edit", compact("post"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:100|min:4',
            'content' => 'required|max:250|min:10',
            'image_url' => 'required',
        ]);
        $data= $request->all(); 
        $data["user_id"] = Auth::user()->id;
        $data['author'] = Auth::user()['name'];
        $post->update($data);

        return redirect()
        ->route('admin.posts.show', $post)
        ->with('message', $data['title']. " è stato modificato con successo.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        
        return redirect()
        ->route('admin.posts.index')
        ->with('deleted-message', "$post->title è stato eliminato con successo dalla lista dei post");
    }
}
