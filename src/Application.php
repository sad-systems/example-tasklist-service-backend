<?php

namespace app;

use app\Interfaces\IRequest;
use app\Interfaces\IResponse;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;

/**
 * Main controller of the application
 *
 * @author     MrDigger <mrdigger@mail.ru>
 * @copyright  © SAD-Systems [http://sad-systems.ru], 2019
 * @created_on 25.06.2019
 */
class Application
{
    private $request;
    private $response;
    private $queryTypeFactory;

    /**
     * Application constructor.
     *
     * @param IRequest         $request
     * @param IResponse        $response
     * @param QueryTypeFactory $queryTypeFactory
     */
    public function __construct(IRequest $request, IResponse $response, QueryTypeFactory $queryTypeFactory)
    {
        $this->request          = $request;
        $this->response         = $response;
        $this->queryTypeFactory = $queryTypeFactory;
    }

    public function run(): string
    {
        try {

            $input     = $this->request->getInputParams();
            $query     = $input['query'];
            $variables = $input['variables'] ?? null;
            $schema    = new Schema([
                'query'    => $this->queryTypeFactory->getRootQueryType(),
                'mutation' => $this->queryTypeFactory->getRootMutationType(),
            ]);

            $result = GraphQL::executeQuery($schema, $query, null, null, $variables)->toArray();

        } catch (\Exception $e) {
            return $this->response->createResponseError($e);
        }

        return $this->response->createResponse($result);
    }
}