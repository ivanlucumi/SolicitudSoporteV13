<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aws\Ses\SesClient;
use Aws\Exception\AwsException;

class SesEmailController extends Controller
{
    public function sendEmail()
    {
        $SesClient = new SesClient([
            'version' => 'latest',
            'region'  => env('AWS_DEFAULT_REGION', 'us-east-2'),
            'credentials' => [
                'key'    => env('AKIAYS2NRB76C3IVBSPE'),
                'secret' => env('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'),
            ],
        ]);

        $recipient_emails = ['gmstdesajvalle3@cendoj.ramajudicial.gov.co']; // Reemplaza con una dirección válida

        try {
            $result = $SesClient->sendEmail([
                'Destination' => [
                    'ToAddresses' => $recipient_emails,
                ],
                'ReplyToAddresses' => ['siriscali@disajcali.gov.co'],
                'Source' => 'siriscali@disajcali.gov.co',
                'Message' => [
                    'Body' => [
                        'Html' => [
                            'Charset' => 'UTF-8',
                            'Data' => 'This email was sent with Amazon SES using the AWS SDK for PHP.',
                        ],
                        'Text' => [
                            'Charset' => 'UTF-8',
                            'Data' => 'This email was sent with Amazon SES using the AWS SDK for PHP.',
                        ],
                    ],
                    'Subject' => [
                        'Charset' => 'UTF-8',
                        'Data' => 'Amazon SES Test Email',
                    ],
                ],
            ]);
            return response()->json(['message' => 'Email sent successfully', 'result' => $result]);
        } catch (AwsException $e) {
            return response()->json(['message' => 'Failed to send email', 'error' => $e->getAwsErrorMessage()]);
        }
    }
}
