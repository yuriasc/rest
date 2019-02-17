<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PostCollection;
use App\Post;

class PostController extends Controller
{
  public function store(Request $request)
  {
    $validate = validator($request->all(),[

      'autor'   => 'required|max:100',
      'titulo'  => 'required|max:255',
      'data'    => 'required|date_format:"d/m/Y"',
      'noticia' => 'required'

    ]);

    if($validate->fails()) {

      return response()->json([
        'message' => 'error',
        'error' => $validate->getMessageBag()
      ], 400);

    }

    $result = Post::where('titulo', $request->titulo)->first();

    if (!$result) {

      $post = Post::create($request->all());

      return response()->json([
        'message' => 'success',
        'notica' => $post
      ], 200);

    } else {

      return response()->json([
        'message' => 'error',
        'error' => 'Título já cadastrado'
      ], 409);

    }

  }

    public function index()
    {
      return new PostCollection(Post::all());
    }

    public function edit($id)
    {
      $post = Post::find($id);
      return response()->json($post);
    }

    public function update($id, Request $request)
    {
      $post = Post::find($id);

      $post->update($request->all());

      return response()->json('successfully updated');
    }

    public function delete($id)
    {
      $post = Post::find($id);

      $post->delete();

      return response()->json('successfully deleted');
    }
}
