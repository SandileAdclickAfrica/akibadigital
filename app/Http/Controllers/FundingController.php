<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FundingController extends Controller
{
    public function index( Request $request ){


        $data = $request->all();

        Log::info('Webhook data:', $data);


//        dd( json_decode($this->getImageAsBase64('image.png')->content())->base64);

        $news_image = public_path('/images/image.png');

        dd( 'Test' );
//        dd( json_decode($this->getImageAsBase64('image.png')->content())->base64 );

        // URL
        $apiURL = 'https://enterprise.akibaone.com/api/v2/widget/save/';

        // POST Data
        $postInput = [
            'loan'                      => '20000',
            'email'                     => 'rafek42477t43estregf@avashost.com',
            'contact_number'            => '0660070724',
            'type'                      => 'Business',
            'step'                      => 'SME South Africa',
            'business_reg_numberpair'   => 'K20174557307',
            'first_name'                => 'Sandile API',
            'last_name'                 => 'API',
            'company_name'              => 'Adclick Test',
            [
                'name' => 'identity',
//                'file' => json_decode($this->getImageAsBase64('image.png')->content())->base64
                'file' => $this->getImageAsBase64( 'image.png' )->content()
            ],
            [
                'name' => 'bankStatement',
//                'file' => json_decode($this->getImageAsBase64('image.png')->content())->base64
                'file' => $this->getImageAsBase64( 'image.png' )->content()
            ],
//            'identity'                  => $news_image,
//            'bankStatement'             => 'pdf',
            'fundingType'               => 'Working Capital (General)',
            'loanDuration'              => 'Very short term (3 months or less)',
            'businessYears'             => '0 - 1 Year',
            'monthlyTurnOver'           => 'R40k - R100k',
            'bank'                      => 'FNB',
            'accountType'               => 'cheque',
            'accountOwner'              => 'business',
            'customerReference'         => 'customerReference',
            'IDnumber'                  => '9408346588086',
            'city'                      => 'Gauteng',
            'postalCode'                => '1724'
        ];

        // Headers
        $headers = [
//            'Content-Type'  => 'multipart/form-data',
            'X-Secret-Key'  => 'Pb7n4nAe.Sqw8CLEkc0MAdr5sOOIMJZUvrXNS2tj3',
//            'Accept'        => 'application/json',
//            'X-CSRFToken'   => 'Pb7n4nAe.Sqw8CLEkc0MAdr5sOOIMJZUvrXNS2tj3'
        ];

        try {
            $response = Http::withHeaders($headers)->post($apiURL, $postInput);

            $statusCode = $response->status();
            $responseBody = json_decode($response->getBody(), true);

            echo $statusCode;  // status code

            dd($responseBody); // body response

            
        } catch (ConnectionException $e) {

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
