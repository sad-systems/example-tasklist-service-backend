<?php

namespace app;

use app\Interfaces\IAuthService;
use app\Interfaces\IStorage;
use app\Interfaces\ITaskService;
use app\Services\AuthService;
use app\Services\TaskService;

/**
 * The factory for query services
 *
 * @author     MrDigger <mrdigger@mail.ru>
 * @copyright  © SAD-Systems [http://sad-systems.ru], 2019
 * @created_on 25.06.2019
 */
class QueryServiceFactory
{
    private $storage;

    private $taskService;
    private $authService;

    public function __construct(IStorage $storage)
    {
        $this->storage = $storage;
    }

    public function getTaskService(): ITaskService
    {
        return $this->taskService ?? $this->taskService = new TaskService($this->storage);
    }

    public function getAuthService(): IAuthService
    {
        return $this->authService ?? $this->authService = new AuthService();
    }
}