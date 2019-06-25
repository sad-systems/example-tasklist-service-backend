<?php

namespace app\Services;

use app\Interfaces\IRequest;

/**
 * Input request service
 *
 * @author     MrDigger <mrdigger@mail.ru>
 * @copyright  © SAD-Systems [http://sad-systems.ru], 2019
 * @created_on 25.06.2019
 */
class Request implements IRequest
{
    /**
     * @inheritdoc
     */
    public function getInputParams(): array
    {
        $rawInput = file_get_contents('php://input');
        return json_decode($rawInput, true) ?? [];
    }
}