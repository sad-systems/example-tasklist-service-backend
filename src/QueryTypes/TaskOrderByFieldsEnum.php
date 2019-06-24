<?php
/**
 * Enums for TaskType ORDER BY statement
 *
 * User: Digger
 * Date: 22.06.2019
 * Time: 13:18
 */

namespace app\QueryTypes;

use GraphQL\Type\Definition\EnumType;

class TaskOrderByFieldsEnum extends EnumType
{
    public function __construct()
    {
        parent::__construct([
            'values' => [ 'name', 'email', 'status' ]
        ]);
    }
}