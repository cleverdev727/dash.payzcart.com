<?php


namespace App\Classes\Utils;


use Aws\S3\S3Client;
use Illuminate\Support\Facades\Log;

class AWSUtils
{

    public static function put($fileObject, $key) {
        try {
            $s3Client =  (new S3Client([
                'region'  => 'ap-south-1',
                'version' => 'latest',
                'credentials' => [
                    'key'       => 'AKIAS2RZP5IEXD2NL4GX',
                    'secret'    => '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'
                ],
            ]));
            $response = $s3Client->putObject([
                "Bucket" => "digipay-support-data-backup-agent",
                "Key" => $key,
                "Body" => $fileObject,
            ]);
            if(isset($response)) {
                return $response;
            }
            return null;
        } catch (\Exception $ex) {
            Log::debug('Error in Exception', [
                'class' => __CLASS__,
                'function' => __METHOD__,
                'file' => $ex->getFile(),
                'line_no' => $ex->getLine(),
                'error_message' => $ex->getMessage(),
            ]);
            return null;
        }
    }

    public static function getSignedURL() {

    }
}
