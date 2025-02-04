<?php

namespace App\Http\Controllers\Ministry;

use App\Http\Controllers\Controller;
use App\Models\HistoryTransfer;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserTransferController extends Controller
{

    

    public function release_user(Request $request)
    {
        DB::beginTransaction(); // Start the transaction

        try {
            // Custom validation with messages
            $validator = Validator::make($request->all(), [
                'staff_id' => 'required|exists:users,staff_id',
                'remarks' => 'nullable',
                'recomanded_ministry' => 'nullable',
            ], [
                'staff_id.required' => 'The staff ID is required.',
                'staff_id.exists' => 'The provided staff ID does not exist in our records.',
            ]);

            // Check for validation failure
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Retrieve the base URL and token from the configuration
            $baseUrl = config('services.ministry_api.base_url');
            $token = config('services.ministry_api.token');
            $ministry_id = config('services.ministry_api.ministry_id');

            // Include ministry_id in the request data
            $requestData = $validator->validated();
            $requestData['ministry_id'] = $ministry_id;

            // Check if user is already released
            $updatedUser = User::where('staff_id', $requestData['staff_id'])->first();
            if ($updatedUser->active_status === 1) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User already released',
                ], 422);
            }

            // Call the external API before inserting into the database
            $client = new Client();
            $response = $client->request('POST', $baseUrl . '/v1/user/callback/release', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
                'json' => $requestData,
            ]);

            // Parse the response body as JSON
            $data = json_decode($response->getBody(), true);
            $statusCode = $response->getStatusCode();

            // If the API response is not 200, rollback the transaction and return error
            if ($statusCode !== 200) {
                DB::rollBack(); // Rollback any DB changes
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to release user from the external API',
                    'api_response' => $data
                ], $statusCode);
            }

            // Update user active status
            $updatedUser->active_status = 1;
            $updatedUser->save();

            // Insert into history_transfer table
            HistoryTransfer::create([
                'staff_id' => $requestData['staff_id'],
                'reason' => $requestData['reason'] ?? null,
                'remarks' => $requestData['remarks'] ?? null,
                'ministry_id' => $requestData['recomanded_ministry'] ?? null,
            ]);

            DB::commit(); // Commit the transaction since everything succeeded

            return response()->json([
                "message" => "User released successfully and history recorded."
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback all changes if any error occurs
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred',
                'line' => $e->getLine(),
                'error' => $e->getMessage()
            ], 403);
        }
    }



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
}
