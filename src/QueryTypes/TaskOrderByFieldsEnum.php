<?php

namespace app\QueryTypes;

use GraphQL\Type\Definition\EnumType;

/**
 * Enums for TaskType ORDER BY statement
 *
 * @author     MrDigger <mrdigger@mail.ru>
 * @copyright  © SAD-Systems [http://sad-systems.ru], 2019
 * @created_on 25.06.2019
 */
class TaskOrderByFieldsEnum extends EnumType
{
    public function __construct()
    {
        parent::__construct([
            'values' => [ 'name', 'email', 'status' ]
        ]);
    }
}