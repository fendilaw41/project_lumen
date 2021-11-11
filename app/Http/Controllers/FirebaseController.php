<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

class FirebaseController extends Controller
{
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'posts';
    }
    public function index()
    {

       $reference  = $this->database->getReference($this->tablename);

        return response()->json([
            'status' => true,
            'message' => "Sukses Menampilkan semua data POSTS FIREBASE",
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
        $postRef = $this->database->getReference($this->tablename)->push($postData);
        dd($postData);

         return response()->json([
            'status' => true,
            'message' => "Berhasil POST FIREBASE",
            'results' => $postRef,
        ], 200);


    }
}
