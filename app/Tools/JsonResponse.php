<?php

namespace App\Tools;

class JsonResponse
{
    const RESPONSE_CODE = 'response_code';
    const RESPONSE_DESCRIPTION = 'response_description';
    const RESPONSE_OBJECT = 'response_object';

    const INVALID_TOKEN = 'invalid token';
    const REQUEST_ACCEPTED = 'request accepted';
    const INVALID_REQUEST = 'invalid request';

    const INPUT_VALIDATION_ERROR = 'input validation error';
    const RECORD_CREATED = 'record created';
    const RECORDS_RETURNED = 'records returned';
    const RECORD_RETURNED = 'record returned';
    const RECORDS_NOT_FOUND = 'records not found';
    const RECORD_NOT_FOUND = 'record not found';
    const RECORDS_CREATED = 'records created';

    public static function successMessage($responseCode, $responseMessage)
    {
        return response()->json(
            [
                JsonResponse::RESPONSE_DESCRIPTION => $responseMessage
            ], $responseCode);
    }

    public static function successObject($responseCode, $responseObject)
    {
        return response()->json( $responseObject, $responseCode);
    }

    public static function json($object)
    {
        return \GuzzleHttp\json_encode($object);
    }
}
