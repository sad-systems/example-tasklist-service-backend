<?php

namespace app\QueryTypes;

use GraphQL\Type\Definition\InputObjectType;

/**
 * Task ORDER BY statement type
 *
 * @author     MrDigger <mrdigger@mail.ru>
 * @copyright  © SAD-Systems [http://sad-systems.ru], 2019
 * @created_on 25.06.2019
 */
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