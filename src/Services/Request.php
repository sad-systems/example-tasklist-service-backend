<?php
/**
 * Input request service
 *
 * User: Digger
 * Date: 22.06.2019
 * Time: 12:06
 */

namespace app\Services;

class Request
{

    public function getInputParams(): array
    {
        $rawInput = file_get_contents('php://input');
        return json_decode($rawInput, true) ?? [];
    }

}