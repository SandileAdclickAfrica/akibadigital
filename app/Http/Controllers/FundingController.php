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

    public function handleFluentFormsWebhook(Request $request){
//        Log::info($request->all());
//        Log::info($request->file());
        Log::info($request->header('Content-Type'));

        if ($request->hasFile('uploaded_file')) {
            $file = $request->file('uploaded_file');

            // Save the file to a specified directory (optional)
            $path = $file->store('uploads');

            return response()->json(['message' => 'File received successfully', 'path' => $path], 200);
        }

        return response()->json(['message' => 'No file found'], 400);

    }

    public function index(Request $request)
    {
        if( $request->method() == 'POST' ) {

        }else{
            return view('funding');
        }
    }

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

//    public function index()
//    {
//        return view('webhook');
//    }

    public function handle2(Request $request)
    {
        if( $request->method() == 'POST' ) {

            $data = $request->all();
//            $data = $request->input('fullnames');
            $bankStatement = $request->file('bankStatement');

            return response()->json([
                'formData' => $data['bankStatement'],
                'status' => 'success',
                'message' => 'Form Submitted',
                'response' => 'Submitted'
            ]);
        }
    }

    public function handleWebhook2(Request $request)
    {
        // Process the incoming request
        $data = $request->all();

        // Validate the request
        $request->validate([
            'bankStatement' => 'required|file',
        ]);

        $file = $request->file('bankStatement');
        return response()->json(['file'=> $file]);

    }

    public function handleWebhook(Request $request)
    {

        if ($request->hasFile('file')) {

            $data = [
                'response' => 'has a file',
            ];

            Log::info('Webhook data received: ', $data);

            return response()->json([
                'status' => 'success',
                'message' => 'File uploaded and forwarded successfully',
                'response' => 'has a file'
            ]);
        }else{

            $data = [
                'form' => $request->all(),
            ];

            Log::info('Webhook data received: ', $data);

            return response()->json([
                'status' => 'success',
                'message' => 'File not uploaded',
                'response' => 'No File Uploaded'
            ]);
        }

        //$bankStatement = $request->file('bankStatement');

//        $data = [
//            'path' => $bankStatement->getPathname(),
//            'name' => $bankStatement->getClientOriginalName()
//        ];

//        Log::info('Webhook data:', (array) $bankStatement );
        //\Log::info('Webhook data received: ', $bankStatement);


//        $identity                   = $request->file('identity');

//        return response()->json(['status' => 'success']);

//        dd( $bankStatement->getPathname() );
//        dd( response()->json(['status' => 'success', 'received' => $bankStatement->getPathname(), 'other' => $bankStatement->getClientOriginalName() ]) );
    }

    public function webhook2(Request $request)
    {
        if( $request->method() == 'POST' ) {

            $data = $request->all();

            $fundingAmount              = '25000';
            $email                      = $data['email'];
            $first_name                 = 'Sandile';
            $last_name                  = 'Mazibuko';
            $contact_number             = '0660060623';
            $type                       = 'Business';
            $step                       = 'SME South Africa';
            $business_reg_number        = 'K20174557307';

            $fundingType                = 'Working Capital (General)';
            $loanDuration               = 'Very short term (3 months or less)';
            $businessYears              = '0 - 1 Year';
            $monthlyTurnOver            = 'R40k - R100k';

            $bank                       = 'FNB';
            $accountType                = 'cheque';
            $accountOwner               = 'business';

            $customerReference          = 'customerReference';
            $IDnumber                   = '9208315233084';
            $city                       = 'Gauteng';
            $postalCode                 = '1724';

//            $bankStatement              = $request->input('bankStatement');
//            $identity                   = $request->input('identity');

            $bankStatement              = $data['bankStatement'];
            $identity                   = $data['identity'];

//            $bankStatement              = $request->file('bankStatement');
//            $identity                   = $request->file('identity');

//            \Log::info('Webhook received', $bankStatement->getPathname());
//            \Log::info('Webhook received', $bankStatement->getClientOriginalName());

            $publicPath = public_path('/images/');

            $apiURL = 'https://enterprise.akibaone.com/api/v2/widget/save/';



            dd( $identity->getPathname() );



            $postInput = [
                [
                    'name'     => 'loan',
                    'contents' => $fundingAmount,
                ],
                [
                    'name'     => 'email',
                    'contents' => $email,
                ],
                [
                    'name'     => 'contact_number',
                    'contents' => $contact_number,
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
                    'contents' => $business_reg_number,
                ],
                [
                    'name'     => 'first_name',
                    'contents' => $first_name,
                ],
                [
                    'name'     => 'last_name',
                    'contents' => $last_name,
                ],
                [
                    'name'     => 'company_name',
                    'contents' => 'Adclick Test',
                ],
                [
                    'name'     => 'fundingType',
                    'contents' => $fundingType,
                ],
                [
                    'name'     => 'loanDuration',
                    'contents' => $loanDuration,
                ],
                [
                    'name'     => 'businessYears',
                    'contents' => $businessYears,
                ],
                [
                    'name'     => 'monthlyTurnOver',
                    'contents' => $monthlyTurnOver,
                ],
                [
                    'name'     => 'bank',
                    'contents' => $bank,
                ],
                [
                    'name'     => 'accountType',
                    'contents' => $accountType,
                ],
                [
                    'name'     => 'accountOwner',
                    'contents' => 'business',
                ],
                [
                    'name'     => 'customerReference',
                    'contents' => $customerReference,
                ],
                [
                    'name'     => 'IDnumber',
                    'contents' => $IDnumber,
                ],
                [
                    'name'     => 'city',
                    'contents' => $city,
                ],
                [
                    'name'     => 'postalCode',
                    'contents' => $postalCode,
                ],
                [
                    'name'     => 'identity', // Name of the file field in the form
                    'contents' => fopen($identity->getPathname(), 'r'), // File path
                    'filename' => $identity->getClientOriginalName(), // Optional: filename to be sent
                ],
                // Uncomment and add more files as needed
                [
                    'name'     => 'bankStatement', // Name of the file field in the form
                    'contents' => fopen($bankStatement->getPathname(), 'r'), // File path
                    'filename' => $bankStatement->getClientOriginalName(), // Optional: filename to be sent
                ],
            ];

            // Headers
            $headers = [
                'X-Secret-Key' => 'Pb7n4nAe.Sqw8CLEkc0MAdr5sOOIMJZUvrXNS2tj3',
                'Accept'      => 'application/json'
            ];

            // Initialize Guzzle Client
            $client = new Client();

            try {
                $response = $client->post( $apiURL , [
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
    public function webhook(Request $request)
    {
        if( $request->method() == 'POST' ) {

            $fundingAmount              = $request->input('loan');
            $email                      = $request->input('email');
            $first_name                 = $request->input('first_name');
            $last_name                  = $request->input('last_name');
            $contact_number             = $request->input('contact_number');
            $type                       = $request->input('type');
            $step                       = $request->input('step');
            $business_reg_number        = $request->input('business_reg_number');

            $fundingType                = $request->input('fundingType');
            $loanDuration               = $request->input('loanDuration');
            $businessYears              = $request->input('businessYears');
            $monthlyTurnOver            = $request->input('monthlyTurnOver');

            $bank                       = $request->input('bank');
            $accountType                = $request->input('accountType');
            $accountOwner               = $request->input('accountOwner');

            $customerReference          = $request->input('customerReference');
            $IDnumber                   = $request->input('IDnumber');
            $city                       = $request->input('city');
            $postalCode                 = $request->input('postalCode');

//            $bankStatement              = $request->input('bankStatement');
//            $identity                   = $request->input('identity');

            $bankStatement              = $request->file('bankStatement');
            $identity                   = $request->file('identity');

//            \Log::info('Webhook received', $bankStatement->getPathname());
//            \Log::info('Webhook received', $bankStatement->getClientOriginalName());

            $publicPath = public_path('/images/');

            $apiURL = 'https://enterprise.akibaone.com/api/v2/widget/save/';

            $postInput = [
                [
                    'name'     => 'loan',
                    'contents' => $fundingAmount,
                ],
                [
                    'name'     => 'email',
                    'contents' => $email,
                ],
                [
                    'name'     => 'contact_number',
                    'contents' => $contact_number,
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
                    'contents' => $business_reg_number,
                ],
                [
                    'name'     => 'first_name',
                    'contents' => $first_name,
                ],
                [
                    'name'     => 'last_name',
                    'contents' => $last_name,
                ],
                [
                    'name'     => 'company_name',
                    'contents' => 'Adclick Test',
                ],
                [
                    'name'     => 'fundingType',
                    'contents' => $fundingType,
                ],
                [
                    'name'     => 'loanDuration',
                    'contents' => $loanDuration,
                ],
                [
                    'name'     => 'businessYears',
                    'contents' => $businessYears,
                ],
                [
                    'name'     => 'monthlyTurnOver',
                    'contents' => $monthlyTurnOver,
                ],
                [
                    'name'     => 'bank',
                    'contents' => $bank,
                ],
                [
                    'name'     => 'accountType',
                    'contents' => $accountType,
                ],
                [
                    'name'     => 'accountOwner',
                    'contents' => 'business',
                ],
                [
                    'name'     => 'customerReference',
                    'contents' => $customerReference,
                ],
                [
                    'name'     => 'IDnumber',
                    'contents' => $IDnumber,
                ],
                [
                    'name'     => 'city',
                    'contents' => $city,
                ],
                [
                    'name'     => 'postalCode',
                    'contents' => $postalCode,
                ],
                [
                    'name'     => 'identity', // Name of the file field in the form
                    'contents' => fopen($identity->getPathname(), 'r'), // File path
                    'filename' => $identity->getClientOriginalName(), // Optional: filename to be sent
                ],
                // Uncomment and add more files as needed
                [
                    'name'     => 'bankStatement', // Name of the file field in the form
                    'contents' => fopen($bankStatement->getPathname(), 'r'), // File path
                    'filename' => $bankStatement->getClientOriginalName(), // Optional: filename to be sent
                ],
            ];

            // Headers
            $headers = [
                'X-Secret-Key' => 'Pb7n4nAe.Sqw8CLEkc0MAdr5sOOIMJZUvrXNS2tj3',
                'Accept'      => 'application/json'
            ];

            // Initialize Guzzle Client
            $client = new Client();

            try {
                $response = $client->post( $apiURL , [
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

    public function testWebhook(Request $request){

        if( $request->method() == 'POST' ) {

            dd( $request->all() );

        }

        return view('webhook');
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
