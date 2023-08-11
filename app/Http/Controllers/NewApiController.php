<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;



class NewApiController extends Controller
{
    public function guzzleapi(Request $request)
    {
        $base_url = 'https://shopify.rewardssandbox.zithara.com/api/v2';
        $endpoint = '/customer/pointsLedger';
    
        // Create a Guzzle HTTP client
        $client = new Client();
    
        // Set headers for the request
        $headers = [
            'Authorization' => 'MHBRaFBxT0RhbHlabTkvMFdYdXJvdz09',
            'Key' => 'bthzca6di5',
            'Content-Type' => 'application/json',
        ];
    
        // Prepare the request body as JSON
        $requestData = [
            'customer_id' => '123',
            'customerPhone' => '8688859854',
            'customerEmail' => 'info@zithara.in',
        ];

    
        try {
            // Send the POST request
            $response = $client->post($base_url . $endpoint, [
                'headers' => $headers,
                'json' => $requestData,
            ]);
    
            // Decode the response JSON into an associative array
            $responseData = json_decode($response->getBody(), true);
    
            // Check if the response status is 404
            if ($responseData['status'] === 404) {
                $errorMessage = $responseData['message']; // Assuming the API response structure
                return response()->json(['message' => $errorMessage], 404);
            }
    
            // Handle success response
            return response()->json($responseData, $responseData['status']);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // Handle client-side errors (4xx)
            $response = $e->getResponse();
            $errorData = json_decode($response->getBody(), true);
            return response()->json($errorData, $errorData['status']);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            // Handle server-side errors (5xx)
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

 
    public function CurlApi(Request $request)
    {
        $base_url = 'https://shopify.rewardssandbox.zithara.com/api/v2';
        $endpoint = '/customer/pointsLedger';

        $headers = [
            'Authorization: MHBRaFBxT0RhbHlabTkvMFdYdXJvdz09',
            'Key: bthzca6di5',
            'Content-Type: application/json',
        ];

        $body = json_encode([
            "customer_id" => "123",
            "customerPhone" => "8688859854",
            "customerEmail" => "info@zithara.in",
        ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $base_url . $endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


        try {
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // it will get status code
           

            if ($httpCode >= 400) {
                $errorData = json_decode($response, true);
                
                if ($errorData['status'] === 404) {
                    return response()->json(['message' => 'Customer does not exist with the provided ID'], 404);
                }

                return response()->json($errorData, $httpCode);
            }

            $data = json_decode($response, true);
            // Handle success response
            return response()->json($data, $data['status']);
        } catch (Exception $e) {
            // Handle other exceptions
            return response()->json(['message' => 'Something went wrong'], 500);
        } finally {
            curl_close($ch);
        }
    }
}
