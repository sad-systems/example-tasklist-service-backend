<?php
/**
 * Output response class
 *
 * User: Digger
 * Date: 22.06.2019
 * Time: 11:54
 */

namespace app\Services;

class Response
{
    public function createError(\Exception $exception) : array
    {
        return [
            'error' => [
                'message' => $exception->getMessage()
            ]
        ];
    }

    public function createResponseError(\Exception $exception): string
    {
        return $this->createResponse( $this->createError($exception) );
    }

    public function createResponse($data): string
    {
        header('Content-Type: application/json; charset=UTF-8');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
        return json_encode($data);
    }
}