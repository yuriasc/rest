<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class NoticiaController extends Controller
{
  public function index() {

  }

  public function create() {
    return view('noticia');
  }

  public function store(Request $request)
  {
    $validate = validator($request->all(),[
      'autor'   => 'required|max:100',
      'titulo'  => 'required|max:255',
      'data'    => 'required|date_format:"d/m/Y"',
      'noticia' => 'required'
    ]);

    if($validate->fails()) {
      return redirect()->back()->withInput()->withErrors($validate->getMessageBag());
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

  public function update($id, $titulo, Request $request)
  {
    $validate = validator($request->all(),[
      'titulo'  => 'required|max:255'
    ]);

    if($validate->fails()) {

      return response()->json([
        'message' => 'error',
        'error' => $validate->getMessageBag()
      ], 400);

    }

    $post = Post::find($id);

    if ($post) {

      $post->update($request->all());

      return response()->json([
        'message' => 'success',
        'notica' => $post
      ], 200);

    } else {

      return response()->json([
        'message' => 'error',
        'error' => 'Notícia não encontrada'
      ], 404);

    }
  }
}
