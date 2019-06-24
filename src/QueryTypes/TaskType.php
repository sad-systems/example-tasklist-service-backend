<?php
/**
 * Task type
 *
 * User: Digger
 * Date: 22.06.2019
 * Time: 13:18
 */

namespace app\QueryTypes;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

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