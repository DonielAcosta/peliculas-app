<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;
use App\Models\Movies;

class ApiController extends Controller{
   
    public function ApiData($title,$year){
        
      
        if(is_null($title && $year)){
            if(empty($title && $year)){
                echo 'una de las variables esta vacia porfavor intente nuevante ';
            }
        }

        $response = Http::get('http://www.omdbapi.com/', [
            'apikey' => 'a0aef06d',
            's' => $title,
            'y' => $year,
            ]);
        $movies = $response->json();
    
        return response()->json(
            [
                'listed' => True,
                'data' => $movies,
                // 'datas' => $resp,
                'message' => 'Has obtenido la pelicula correctamente'
            ],
            200
        );
   }
}
