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
    $post = Post::where('id', $id)->get();

    if ($post->isNotEmpty()) {

      $html = '<div>';

      foreach($post as $val) {
        $html .= '<div>' . $val->id . '</div>';
        $html .= '<div>' . $val->titulo . '</div>';
        $html .= '<div>' . $val->autor . '</div>';
        $html .= '<div>' . $val->data . '</div>';
        $html .= '<div>' . $val->noticia . '</div>';
      }

      $html .= '</div>';

      return response($html)->header('Content-type', 'text/html');

    } else {

      return response()->json([
        'message' => 'error',
        'error' => 'Notícia não encontrada'
      ], 404);

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

  public function delete($id)
  {
    $post = Post::find($id);

    if ($post) {

      $post->delete();

      return response()->xml($post, $status = 200, $headers = [ 'Content-Type' => ' text/xml']);

    } else {

      return response()->json([
        'message' => 'error',
        'error' => 'Notícia não encontrada'
      ], 404);

    }

  }
}
