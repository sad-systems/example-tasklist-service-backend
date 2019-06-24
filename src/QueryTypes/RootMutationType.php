<?php
/**
 * The root mutation type
 *
 * User: Digger
 * Date: 22.06.2019
 * Time: 12:29
 */

namespace app\QueryTypes;

use app\QueryServiceFactory;
use app\QueryTypeFactory;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class RootMutationType extends ObjectType
{
    public function __construct(QueryTypeFactory $queryTypeFactory, QueryServiceFactory $queryServiceFactory)
    {
        parent::__construct([
            'fields' => function () use ($queryTypeFactory, $queryServiceFactory) { return [
                'task_new' => [
                    'type' => Type::string(),
                    'description' => 'Adds a new task. Returns the ID of the new task or null',
                    'args' => [
                        'text'   => Type::nonNull(Type::string()),
                        'email'  => Type::nonNull(new EmailType()),
                        'name'   => Type::string(),
                        'status' => Type::boolean(),
                    ],
                    'resolve' => function ($root, $args) use ($queryServiceFactory) {
                        return $queryServiceFactory->getTaskService()->createNewTask($args['text'], $args['email'], $args['name'] ?? '', $args['status'] ?? false);
                    }
                ],
                'task_edit' => [
                    'type' => Type::boolean(),
                    'description' => 'Changes the existing task. Returns TRUE if changes are made, FALSE otherwise.',
                    'args' => [
                        'token'  => Type::nonNull(Type::string()),
                        'id'     => Type::nonNull(Type::string()),
                        'text'   => Type::nonNull(Type::string()),
                        'status' => Type::boolean(),
                    ],
                    'resolve' => function ($root, $args) use ($queryServiceFactory) {
                        $queryServiceFactory->getAuthService()->checkAccess($args['token']);
                        return $queryServiceFactory->getTaskService()->editExistedTask($args['id'], $args['text'], $args['status'] ?? false);
                    }
                ],
            ]; }
        ]);
    }
}