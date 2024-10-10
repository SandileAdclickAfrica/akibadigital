<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Array_;

class FundingController extends Controller
{
    public function index(Request $request)
    {
        if( $request->method() == 'POST' ) {


            // Validate the form data
            $validatedData = $request->validate([
                'loan' => 'required|numeric|min:10000|max:5000000',
                'email' => 'required|email',
                'first_name' => 'required',
                'last_name' => 'required',
                'contact_number' => 'required|numeric|regex:/^0\d{9}$/',
                'business_reg_number' => 'required|regex:/^[A-Z]\d{11}$/',
                'fundingType' => 'required',
                'loanDuration' => 'required',
                'businessYears' => 'required',
                'monthlyTurnOver' => 'required',
                'bank' => 'required',
                'accountType' => 'required',
                'customerReference' => 'required',
                'IDnumber' => 'required|digits:13',
                'city' => 'required',
                'postalCode' => 'required|numeric',

            ], [
                'business_reg_number' => 'The registration number must start with an uppercase letter followed by 11 digits.',
            ]);


            // Define the validation rules
            $validator = Validator::make($request->all(), [
                'bankStatement' => [
                    'required',
                    'file',
                    'mimes:jpg,jpeg,gif,png,bmp,doc,ppt,pps,xls,mdb,docx,xlsx,pptx,odt,odp,ods,odg,odc,odb,odf,rtf,txt,pdf',
                    'max:2048' // Maximum file size in kilobytes (2 MB in this case)
                ],
                'identity' => [
                    'required',
                    'file',
                    'mimes:jpg,jpeg,gif,png,bmp,doc,ppt,pps,xls,mdb,docx,xlsx,pptx,odt,odp,ods,odg,odc,odb,odf,rtf,txt,pdf',
                    'max:2048' // Maximum file size in kilobytes (2 MB in this case)
                ],
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                dd($validator->errors());
            }

            dd( $request->all() );

        }else{
            return view('funding');
        }
    }

    public function webhook(Request $request)
    {
        if( $request->method() == 'POST' ) {

            $data = $request->all();

            Log::info('Webhook received', $data);

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


            $fluentFormsInputs = $request->all();
            $bankStatementURL = $fluentFormsInputs['bankStatement'][0];
            $identityURL = $fluentFormsInputs['identity'][0];

//            $bankStatement              = $request->file('bankStatement');
//            $identity                   = $request->file('identity');

//            \Log::info('Webhook received', $bankStatement->getPathname());
//            \Log::info('Webhook received', $bankStatement->getClientOriginalName());

            $publicPath = public_path('/images/');

            $apiURL = 'https://enterprise.akibaone.com/api/v2/widget/save/';

//            dd( $identity->getPathname() );

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
                    'contents' => $this->processDownload( $identityURL ),
                    'filename' => basename($identityURL), // Optional: filename to be sent
                ],
                // Uncomment and add more files as needed
                [
                    'name'     => 'bankStatement', // Name of the file field in the form
                    'contents' => $this->processDownload( $bankStatementURL ),
                    'filename' => basename($bankStatementURL), // Optional: filename to be sent
                ],

//                [
//                    'name'     => 'identity', // Name of the file field in the form
//                    'contents' => fopen($identity->getPathname(), 'r'), // File path
//                    'filename' => $identity->getClientOriginalName(), // Optional: filename to be sent
//                ],
//                // Uncomment and add more files as needed
//                [
//                    'name'     => 'bankStatement', // Name of the file field in the form
//                    'contents' => fopen($bankStatement->getPathname(), 'r'), // File path
//                    'filename' => $bankStatement->getClientOriginalName(), // Optional: filename to be sent
//                ],
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

                // Return the response data
                return response()->json([
                    'status_code' => $response->getStatusCode(),
                    'body' => json_decode( $response->getBody()->getContents() ), // Decode if the response is JSON
                ]);

            } catch (RequestException $e) {
                if ($e->hasResponse()) {
                    $responseBody = $e->getResponse()->getBody()->getContents();
                    return json_decode($responseBody, true);
                } else {
                    return $e->getMessage();
                }
            } catch (GuzzleException $e) {
            }
        }

        if ($request->isMethod('get')) {
            return response()->json(['message' => 'This is a GET request']);
        }
    }

    private function processDownload( $fileUrl )
    {
        $client = new Client();
        // Make a GET request to fetch the file and pass it via webhook
        try {

            $filename = basename($fileUrl);

            // Fetch the file
            $response = $client->get($fileUrl, [
                'sink' => storage_path('app/'.$filename) // Save the file temporarily
            ]);

            // Open the file for reading
            $file = fopen(storage_path('app/'.$filename), 'r');

            return $file;

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
