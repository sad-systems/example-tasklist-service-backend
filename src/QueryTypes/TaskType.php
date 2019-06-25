<?php

namespace app\QueryTypes;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * Task type
 *
 * @author     MrDigger <mrdigger@mail.ru>
 * @copyright  © SAD-Systems [http://sad-systems.ru], 2019
 * @created_on 25.06.2019
 */
class TaskType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'fields' => [
                'id' => [
                    'type' => Type::string(),
                    'description' => 'The task ID',
                ],
                'name' => [
                    'type' => Type::string(),
                    'description' => 'Author name',
                ],
                'email' => [
                    'type' => Type::string(),
                    'description' => 'Author email',
                ],
                'text' => [
                    'type' => Type::string(),
                    'description' => 'The text',
                ],
                'status' => [
                    'type' => Type::boolean(),
                    'description' => 'Status "Done"',
                ],
            ]
        ]);
    }
}