<?php
/**
 * Main controller of the application
 *
 * User: MrDigger
 * Date: 22.06.2019
 * Time: 10:51
 */
namespace app;

use app\Services\Request;
use app\Services\Response;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;

class Application
{

    private $request;
    private $response;
    private $queryTypeFactory;

    public function __construct(Request $request, Response $response, QueryTypeFactory $queryTypeFactory)
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