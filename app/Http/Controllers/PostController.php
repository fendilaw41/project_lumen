<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::get();

        return response()->json([
            'status' => true,
            'message' => "Sukses Menampilkan semua data Post",
            'results' => $post
        ]);
    }

     public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required',
            'body' => 'required',
        ]);
        try {
            $post = new Post;
            $post->title = $request->title;
            $post->slug = $request->slug;
            $post->body = $request->body;
            $post->save();
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Gagal Simpan Posts",
                'error' => $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'status' => true,
            'message' => "Berhasil Simpan Posts",
             'results' => $post,
        ], 200);
    }

    public function show($id)
    {
        if (Post::where('_id', $id)->exists())
          {
            $post = Post::where('_id', $id)->get();
            return response()->json([
                'status' => true,
                'result' => $post
            ]);
        } else {

              return response()->json([
                'message' => "Data Post Tidak ditemukan",
             ]);
        }

        
    }

    public function update(Request $request, $id)
    {
       
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required',
            'body' => 'required',
           ]);
        try {
            $post = Post::findOrFail($id);
            $post->title = $request->title;
            $post->slug = $request->slug;
            $post->body = $request->body;
            $post->update();

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Gagal Update Posts",
                'error' => $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'status' => true,
            'message' => "Berhasil Update Posts",
            'results' => $post,
        ], 200);
    }

    public function destroy($id)
    {

        
        $post = Post::findOrFail($id)->delete();
        return response()->json([
            'status' => true,
            'message' => "Berhasil Delete Posts",
        ], 200);
    }
}
