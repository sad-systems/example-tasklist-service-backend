<?php

namespace app\QueryTypes;

use app\QueryServiceFactory;
use app\QueryTypeFactory;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * The root mutation type
 *
 * @author     MrDigger <mrdigger@mail.ru>
 * @copyright  © SAD-Systems [http://sad-systems.ru], 2019
 * @created_on 25.06.2019
 */
class RootMutationType extends ObjectType
{
    public function __construct(QueryTypeFactory $queryTypeFactory, QueryServiceFactory $queryServiceFactory)
    {
        parent::__construct([
            'fields' => function () use ($queryTypeFactory, $queryServiceFactory) { return [
                'taskNew' => [
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
                'taskEdit' => [
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