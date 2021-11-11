<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\Post;

class PostTest extends TestCase
{

     public function testAllPost()
    {

     $response = $this->json('GET', 'api/posts');

       return response()->json('success', 201);

    }

      public function testIdPost()
    {

       $response = $this->json('GET', 'api/posts/1');

       return response()->json('success', 201);

    }

      public function testStorePost()
    {

         $post_data = [
            "title" => "John Doe",
            "body" => "Jakarta",
            "slug" => "12345",
        ];

       $response = $this->json('POST', 'api/posts', $post_data)
        ->seeStatusCode(200)
            ->seeJsonStructure(
                [
                 "status" => true,
                 "message" => "Berhasil Simpan Posts",
                 "results" => [
                    [
                        "title" => "Title Fendi 2",
                        "slug" => "Slug Fendi 3",
                        "body" => "Body Fendi 5",
                        "updated_at" => "2021-11-10T18:36:28.725000Z",
                        "created_at" => "2021-11-10T18:36:28.725000Z",
                        "_id" => "618c112c7e0f000044002162"
                    ],
                ],
               
            ]);


    }


      public function testUpdatePost()
    {
          $post_data = [
            "title" => "John Doe",
            "body" => "Jakarta",
            "slug" => "12345",
        ];

       $response = $this->json('PUT', 'api/posts/1', $post_data);

       return response()->json('success', 201);

    }

     public function testDeletePost()
    {

       $response = $this->json('delete', 'api/posts/1');

       return $response->json('success', 201);

    }
}
