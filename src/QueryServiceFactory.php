<?php
/**
 * The factory for query services
 *
 * User: Digger
 * Date: 22.06.2019
 * Time: 14:54
 */

namespace app;

use app\Services\AuthService;
use app\Services\TaskService;

class QueryServiceFactory
{
    private $storage;

    private $taskService;
    private $authService;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    public function getTaskService()
    {
        return $this->taskService ?? $this->taskService = new TaskService($this->storage);
    }

    public function getAuthService()
    {
        return $this->authService ?? $this->authService = new AuthService();
    }
}