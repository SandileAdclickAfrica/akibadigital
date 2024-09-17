<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\Array_;

class FundingController extends Controller
{

    public function handle( Request $request ): \Illuminate\Http\JsonResponse
    {
        Log::info('Webhook data:', (array) $request->getContent());
        return response()->json(['detail' => 'Success'], 200);
    }

//    public function index( Request $request ){
//
//        $data = $request->all();
//
//        Log::info('Webhook data:', $data);
//
////        $basePath = base_path().'/public/images/';
//        $publicPath = public_path('/images/');
//
//        // URL
//        $apiURL = 'https://enterprise.akibaone.com/api/v2/widget/save/';
//
//        // POST Data
//        $postInput = [
//            'loan'                      => '20000',
//            'email'                     => 'test09f@adclickafrica.com',
//            'contact_number'            => '0660070724',
//            'type'                      => 'Business',
//            'step'                      => 'SME South Africa',
//            'business_reg_number'       => 'K20174557307',
//            'first_name'                => 'Sandile API',
//            'last_name'                 => 'API',
//            'company_name'              => 'Adclick Test',
//            'fundingType'               => 'Working Capital (General)',
//            'loanDuration'              => 'Very short term (3 months or less)',
//            'businessYears'             => '0 - 1 Year',
//            'monthlyTurnOver'           => 'R40k - R100k',
//            'bank'                      => 'FNB',
//            'accountType'               => 'cheque',
//            'accountOwner'              => 'business',
//            'customerReference'         => 'customerReference',
//            'IDnumber'                  => '9408346588086',
//            'city'                      => 'Gauteng',
//            'postalCode'                => '1724',
//            [
//                'name'     => 'identity', // Name of the file field in the form
//                'contents' => fopen($publicPath . 'image.png', 'r'), // File path
//                'filename' => 'image.png', // Optional: filename to be sent
//            ],
//    ];
//
////        dd( $postInput );
//
//        // Headers
//        $headers = [
////            'Content-Type'  => 'multipart/form-data',
//            'X-Secret-Key'  => 'Pb7n4nAe.Sqw8CLEkc0MAdr5sOOIMJZUvrXNS2tj3',
//            'Accept'        => 'application/json',
////            'X-CSRFToken'   => 'Pb7n4nAe.Sqw8CLEkc0MAdr5sOOIMJZUvrXNS2tj3'
//        ];
//
//
//
//
//        try {
//            $response = Http::withHeaders( $headers )->post(
//                $apiURL,
//                [
//                    'multipart' => $postInput
//                ]
//            );
//
//            $statusCode = $response->status();
//            $responseBody = json_decode($response->getBody(), true);
//
//            echo $statusCode;  // status code
//
//            dd($responseBody); // body response
//
//        } catch (ConnectionException $e) {
//
//        }
//
//    }


    public function index()
    {
        return view('webhook');
    }

    public function handleWebhook(Request $request)
    {
        // Log the request for debugging purposes
        \Log::info('Webhook received', $request->all());

        $name = $request->input('name');

        // Process the webhook data here...
//        return response()->json(['status' => 'success']);
        return response()->json(['status' => 'success', 'received' => $name]);
    }



    public function webhook(Request $request)
    {
        if( $request->method() == 'POST' ) {
            Log::info('Webhook data');

            $publicPath = public_path('/images/');

            $apiURL = 'https://enterprise.akibaone.com/api/v2/widget/save/';

            $postInput = [
                [
                    'name'     => 'loan',
                    'contents' => '20000',
                ],
                [
                    'name'     => 'email',
                    'contents' => 'msentricreatives@gmail.com',
                ],
                [
                    'name'     => 'contact_number',
                    'contents' => '0660070724',
                ],
                [
                    'name'     => 'type',
                    'contents' => 'Business',
                ],
                [
                    'name'     => 'step',
                    'contents' => 'SME South Africa',
                ],
                [
                    'name'     => 'business_reg_number',
                    'contents' => 'K20174557307',
                ],
                [
                    'name'     => 'first_name',
                    'contents' => 'Sandile',
                ],
                [
                    'name'     => 'last_name',
                    'contents' => 'Msentri',
                ],
                [
                    'name'     => 'company_name',
                    'contents' => 'Adclick Test',
                ],
                [
                    'name'     => 'fundingType',
                    'contents' => 'Working Capital (General)',
                ],
                [
                    'name'     => 'loanDuration',
                    'contents' => 'Very short term (3 months or less)',
                ],
                [
                    'name'     => 'businessYears',
                    'contents' => '0 - 1 Year',
                ],
                [
                    'name'     => 'monthlyTurnOver',
                    'contents' => 'R40k - R100k',
                ],
                [
                    'name'     => 'bank',
                    'contents' => 'FNB',
                ],
                [
                    'name'     => 'accountType',
                    'contents' => 'cheque',
                ],
                [
                    'name'     => 'accountOwner',
                    'contents' => 'business',
                ],
                [
                    'name'     => 'customerReference',
                    'contents' => 'customerReference',
                ],
                [
                    'name'     => 'IDnumber',
                    'contents' => '9408346588086',
                ],
                [
                    'name'     => 'city',
                    'contents' => 'Gauteng',
                ],
                [
                    'name'     => 'postalCode',
                    'contents' => '1724',
                ],
                [
                    'name'     => 'identity', // Name of the file field in the form
                    'contents' => fopen($publicPath . 'image.png', 'r'), // File path
                    'filename' => 'image.png', // Optional: filename to be sent
                ],
                // Uncomment and add more files as needed
                [
                    'name'     => 'bankStatement', // Name of the file field in the form
                    'contents' => fopen($publicPath . 'image.png', 'r'), // File path
                    'filename' => 'image.png', // Optional: filename to be sent
                ],
            ];

            // Headers
            $headers = [
                'X-Secret-Key' => env('AKIBA_DIGITAL_X_SECRET_KEY'),
                'Accept'      => 'application/json',
            ];

            // Initialize Guzzle Client
            $client = new Client();

            try {
                $response = $client->post( env('akiba_digital_endpoint_url') , [
                    'headers' => $headers,
                    'multipart' => $postInput,
                ]);

                $statusCode = $response->getStatusCode();
                $responseBody = json_decode($response->getBody(), true);

                //echo $statusCode;  // status code

                //dd($responseBody); // body response

                return $responseBody;

            } catch (RequestException $e) {
                if ($e->hasResponse()) {
                    $responseBody = $e->getResponse()->getBody()->getContents();
                    return json_decode($responseBody, true);
                } else {
                    return $e->getMessage();
                }
            }
        }

        if ($request->isMethod('get')) {
            return response()->json(['message' => 'This is a GET request']);
        }
    }

    public function getImageAsBase64($filename): \Illuminate\Http\JsonResponse
    {
        // Path to the image in the public directory
        $path = public_path('images/' . $filename);

        // Check if file exists
        if (!file_exists($path)) {
            return response()->json(['error' => 'File not found.'], 404);
        }

        // Get the file contents
        $fileContents = file_get_contents($path);

        // Get the MIME type of the file
        $mimeType = mime_content_type($path);

        // Encode the file contents to Base64
        $base64 = base64_encode($fileContents);

        // Format the Base64 string with MIME type
        $base64String = "data:$mimeType;base64,$base64";

        return response()->json(['base64' => $base64String]);
    }
}
