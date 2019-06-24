<?php
/**
 * The factory for query types
 *
 * User: Digger
 * Date: 22.06.2019
 * Time: 12:26
 */

namespace app;

use app\QueryTypes\RootMutationType;
use app\QueryTypes\RootQueryType;
use app\QueryTypes\TaskType;

class QueryTypeFactory
{

    private $queryServiceFactory;

    private $query;
    private $mutation;
    private $task;

    public function __construct(QueryServiceFactory $queryServiceFactory)
    {
        $this->queryServiceFactory = $queryServiceFactory;
    }

    public function getRootQueryType()
    {
        return $this->query ?? $this->query = new RootQueryType($this, $this->queryServiceFactory);
    }

    public function getRootMutationType()
    {
        return $this->mutation ?? $this->mutation = new RootMutationType($this, $this->queryServiceFactory);
    }

    public function getTaskType()
    {
        return $this->task ?? $this->task = new TaskType();
    }

}