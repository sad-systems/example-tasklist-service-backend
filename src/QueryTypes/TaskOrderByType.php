<?php
/**
 * Task ORDER BY statement type
 *
 * User: Digger
 * Date: 22.06.2019
 * Time: 13:18
 */

namespace app\QueryTypes;

use GraphQL\Type\Definition\InputObjectType;

class TaskOrderByType extends InputObjectType
{
    public function __construct()
    {
        parent::__construct([
            'fields' => [
                'field'     => new TaskOrderByFieldsEnum(),
                'direction' => new OrderByDirEnum(),
            ]
        ]);
    }
}