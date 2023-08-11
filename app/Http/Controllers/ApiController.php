<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;



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


    // use GuzzleHttp\Client;

    public function fetchNewsFromAPI(Request $request)
    {
        $base_url = 'https://newsapi.org/v2/everything';
        
        $queryParams = [
            'q' => 'apple',
            'from' => '2023-07-10',
            'to' => '2023-07-10',
            'sortBy' => 'popularity',
            'apiKey' => '69126ce075144499b694a1d2530f715c',
        ];
    
        // Create a Guzzle HTTP client
        $client = new Client();
    
        // Set headers for the request
        $headers = [
            'Content-Type' => 'application/json',
        ];
    
        try {
            // Send the GET request
            $response = $client->get($base_url, [
                'headers' => $headers,
                'query' => $queryParams,
            ]);
    
            // Decode the response JSON into an associative array
            $responseData = json_decode($response->getBody(), true);
    
            // Check if the request was successful (status code 200)
            if ($response->getStatusCode() == 200) {
                // Handle success response
                return response()->json($responseData, $response->getStatusCode());
            } else {
                // Handle other status codes (e.g., 4xx, 5xx)
                return response()->json(['message' => 'Request failed'], $response->getStatusCode());
            }
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // Handle client-side errors (4xx)
            $response = $e->getResponse();
            $errorData = json_decode($response->getBody(), true);
            return response()->json($errorData, $errorData['status']);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            // Handle server-side errors (5xx)
            return response()->json(['message' => 'Something went wrong'], 500);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the request
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }
    
    


    
}
