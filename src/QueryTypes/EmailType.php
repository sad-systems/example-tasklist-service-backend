<?php
/**
 * Email type
 *
 * User: Digger
 * Date: 22.06.2019
 * Time: 13:18
 */

namespace app\QueryTypes;

use app\Exceptions\IncorrectValue;
use GraphQL\Type\Definition\ScalarType;

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