<?php

namespace app\QueryTypes;

use app\Exceptions\IncorrectValue;
use GraphQL\Type\Definition\ScalarType;

/**
 * Email type
 *
 * @author     MrDigger <mrdigger@mail.ru>
 * @copyright  © SAD-Systems [http://sad-systems.ru], 2019
 * @created_on 25.06.2019
 */
class EmailType extends ScalarType
{
    public function serialize($value)
    {
        return $value;
    }

    public function parseValue($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new IncorrectValue('Email');
        }
        return $value;
    }

    public function parseLiteral($valueNode, ?array $variables = null)
    {
        if (!filter_var($valueNode->value, FILTER_VALIDATE_EMAIL)) {
            throw new IncorrectValue('Email');
        }
        return $valueNode->value;
    }
}