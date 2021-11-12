<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Kreait\Firebase\Database;

class FirebaseController extends Controller
{
    protected $database;

    public function __construct()
    {
        
        $database = app('firebase.database');
    }

     public function index()
    {
        $reference = $database->getReference('Posts');

        return response()->json([
            'status' => true,
            'message' => "Sukses Menampilkan semua data Post",
            'results' => $reference
        ]);
    }

    public function store(Request $request)
    {
        $postData = [
            'title' => $request->title,
            'body' => $request->body,
            'slug' => $request->slug,
        ];
        $postRef = $this->database->getReference('posts')->push($postData);
        dd($postData);

         return response()->json([
            'status' => true,
            'message' => "Berhasil POST FIREBASE",
            'results' => $postRef,
        ], 200);


    }
}
