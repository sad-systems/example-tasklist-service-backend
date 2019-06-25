<?php

namespace app\QueryTypes;

use app\QueryServiceFactory;
use app\QueryTypeFactory;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * The root query type
 *
 * @author     MrDigger <mrdigger@mail.ru>
 * @copyright  © SAD-Systems [http://sad-systems.ru], 2019
 * @created_on 25.06.2019
 */
class RootQueryType extends ObjectType
{
    public function __construct(QueryTypeFactory $queryTypeFactory, QueryServiceFactory $queryServiceFactory)
    {
        parent::__construct([
            'fields' => function () use ($queryTypeFactory, $queryServiceFactory) { return [
                'tasks' => [
                    'type' => Type::listOf(new TaskType()),
                    'description' => 'Task List with pagination and sorting',
                    'args' => [
                        'offset' => Type::int(),
                        'limit'  => Type::int(),
                        'order'  => Type::listOf(new TaskOrderByType()),
                    ],
                    'resolve' => function ($root, $args) use ($queryServiceFactory) {
                        return $queryServiceFactory->getTaskService()->getTasks($args['offset'] ?? 0, $args['limit']  ?? 3, $args['order'] ?? []);
                    }
                ],
                'tasks_total' => [
                    'type' => Type::int(),
                    'description' => 'the total count of tasks',
                    'resolve' => function ($root, $args) use ($queryServiceFactory) {
                        return $queryServiceFactory->getTaskService()->getTaskTotalCount();
                    }
                ],
                'access' => [
                    'type' => Type::string(),
                    'description' => 'Requests token authorization. If successful, the access_token is returned, otherwise null',
                    'args' => [
                        'user' => Type::nonNull(Type::string()),
                        'pass' => Type::nonNull(Type::string()),
                    ],
                    'resolve' => function ($root, $args) use ($queryServiceFactory) {
                        return $queryServiceFactory->getAuthService()->getAccessToken($args['user'], $args['pass']);
                    }
                ],
            ]; }
        ]);
    }
}