<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FilterController extends Controller
{
   public function index()
   {
     $jsonString = file_get_contents(base_path('resources/filter.json'));
     $data = json_decode($jsonString, true);

     $filter = $data['data']['response']['billdetails'];
     $denom = "360";

        $filtered = collect($filter)->filter(function ($item) use ($denom) {
            return false !== stristr($item['currency'], $denom);
        });

      return response()->json(var_dump($filtered));
      // return response()->json($filtered);
      // return response()->json($data);
   }
}
