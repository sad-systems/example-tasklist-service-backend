<?php

namespace app\Services;

use app\Interfaces\IResponse;

/**
 * Output response class
 *
 * @author     MrDigger <mrdigger@mail.ru>
 * @copyright  © SAD-Systems [http://sad-systems.ru], 2019
 * @created_on 25.06.2019
 */
class Response implements IResponse
{
    /**
     * @inheritdoc
     */
    public function createError(\Exception $exception): array
    {
        return [
            'error' => [
                'message' => $exception->getMessage()
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function createResponseError(\Exception $exception): string
    {
        return $this->createResponse( $this->createError($exception) );
    }

    /**
     * @inheritdoc
     */
    public function createResponse($data): string
    {
        header('Content-Type: application/json; charset=UTF-8');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
        return json_encode($data);
    }
}