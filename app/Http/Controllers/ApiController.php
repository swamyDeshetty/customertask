<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    

    // Fetching the apidata from news api and showing in the jquery datatable.....
    public function index()
    {
        $response = Http::get('https://newsapi.org/v2/everything', [
            'q' => 'apple',
            'from' => '2023-07-10',
            'to' => '2023-07-10',
            'sortBy' => 'popularity',
            'apiKey' => '69126ce075144499b694a1d2530f715c',
        ]);
    
        $articles = $response->json()['articles']; // it is used to converting json data to associative array
    
        $data = []; //empty array 
    
        foreach ($articles as $article) {
            $data[] = [
                $article['source']['name'],
                $article['author'],
                $article['title'],
                $article['description'],
                $article['url'],
                $article['urlToImage'],
                $article['publishedAt'],
                $article['content']
            ];
        }
    
        return view('api', compact('data'));
    }
    

   
    

    public function show()  
    {
        $data['questions']= Question::all();
        return view('welcome',$data);
    }

     // // This is the api data from newsapi 
    // public function index1()
    // {
    //     $response = Http::get('https://newsapi.org/v2/everything', [
    //         'q' => 'apple',
    //         'from' => '2023-07-10',
    //         'to' => '2023-07-10',
    //         'sortBy' => 'popularity',
    //         'apiKey' => '69126ce075144499b694a1d2530f715c',
    //     ]);
    
    //     $articles = $response->json()['articles'];
    //     $limitedArticles = array_slice($articles, 0, 5);
    
    //     return $limitedArticles;
    // }
    
}
