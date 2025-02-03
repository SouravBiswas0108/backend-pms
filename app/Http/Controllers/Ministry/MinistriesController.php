<?php

namespace App\Http\Controllers\Ministry;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MinistriesController extends Controller
{
    //
    //validate wheather the user exist in centralized database or not 

    public function validateUser($validatedData)
    {
        $queryParams = [
            'staff_id' => $validatedData['staff_id'],
            'ippis_no' => $validatedData['ippis_no'],
            'email' => $validatedData['email']
        ];

        $client = new Client();

        // Retrieve the base URL and token from the configuration
        $baseUrl = config('services.ministry_api.base_url');
        $token = config('services.ministry_api.token');

        try {
            // Make the GET request with the token in the headers
            $response = $client->request('GET', $baseUrl . '/v1/validateuser', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
                'query' => $queryParams,
            ]);

            // Parse the response body as JSON
            $data = json_decode($response->getBody(), true);

            if ($response->getStatusCode() === 200 && $data['answer'] === true) {
                // User already exists
                return response()->json([
                    "message" => "User already exists"
                ], 422);
            }

            return null; // No issue, continue processing
        } catch (\Exception $e) {
            // Handle errors (e.g., 401, 500, etc.)
            return response()->json(['error' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }

    //create user 

    public function createUser($validatedData)
    {

        $queryParams = [
            'staff_id' => $validatedData['staff_id'],
            'ippis_no' => $validatedData['ippis_no'],
            'email' => $validatedData['email'],
            'f_Name' => $validatedData['F_Name'],
            'm_Name' => $validatedData['M_Name'],
            'l_Name' => $validatedData['L_Name'],
            'phone' => $validatedData['phone'],
            'job_Title' => $validatedData['job_Title'],
            'designation' => $validatedData['Designation'],
            'cadre' => $validatedData['cadre'],
            'date_of_current_posting' => $validatedData['date_of_current_posting'],
            'date_of_MDA_posting' => $validatedData['date_of_MDA_posting'],
            'date_of_last_promotion' => $validatedData['date_of_last_promotion'],
            'gender' => $validatedData['gender'],
            'recovery_email' => $validatedData['recovery_email'],
            'grade_level' => $validatedData['grade_level'],
            'ministry_id' => $validatedData['ministry']

        ];

        $client = new Client();

        // Retrieve the base URL and token from the configuration
        $baseUrl = config('services.ministry_api.base_url');
        $token = config('services.ministry_api.token');

        try {
            // Make the POST request with the token in the headers
            $response = $client->request('POST', $baseUrl . '/v1/createuser', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
                'json' => $queryParams,  // Send as JSON
            ]);

            // Parse the response body as JSON
            $data = json_decode($response->getBody(), true);

            if ($response->getStatusCode() === 201) {
                # code...
                return true;
            }

            return null; // No issue, continue processing
        } catch (\Exception $e) {
            // Handle errors (e.g., 401, 500, etc.)
            return response()->json(['error' => $e->getMessage()], $e->getCode() ?: 500);
        }
        return response()->json(123);
    }

 
    public function updateUser($validatedData,$user){

       
        $queryParams = [
            'f_Name' => $validatedData['F_Name'],
            'm_Name' => $validatedData['M_Name'],
            'l_Name' => $validatedData['L_Name'],
            'phone' => $validatedData['phone'],
            'job_Title' => $validatedData['job_Title'],
            'designation' => $validatedData['Designation'],
            'cadre' => $validatedData['cadre'],
            'date_of_current_posting' => $validatedData['date_of_current_posting'],
            'date_of_MDA_posting' => $validatedData['date_of_MDA_posting'],
            'date_of_last_promotion' => $validatedData['date_of_last_promotion'],
            'gender' => $validatedData['gender'],
            'recovery_email' => $validatedData['recovery_email'],
            'grade_level' => $validatedData['grade_level'],

        ];


        $client = new Client();

        // Retrieve the base URL and token from the configuration
        $baseUrl = config('services.ministry_api.base_url');
        $token = config('services.ministry_api.token');

        try {
            // Make the POST request with the token in the headers
            $response = $client->request('POST', $baseUrl . '/v1/updateuser/'.$user, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
                'json' => $queryParams,  // Send as JSON
            ]);

            // Parse the response body as JSON
            $data = json_decode($response->getBody(), true);

            

            if ($response->getStatusCode() === 200) {
                # code...
                return true;
            }

            return null; // No issue, continue processing
        } catch (\Exception $e) {
            // Handle errors (e.g., 401, 500, etc.)
            return response()->json(['error' => $e->getMessage()], $e->getCode() ?: 500);
        }

        dd($user);

    }
}
