<?php

namespace app;

use app\QueryTypes\RootMutationType;
use app\QueryTypes\RootQueryType;
use app\QueryTypes\TaskType;

/**
 * The factory for query types
 *
 * @author     MrDigger <mrdigger@mail.ru>
 * @copyright  © SAD-Systems [http://sad-systems.ru], 2019
 * @created_on 25.06.2019
 */
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