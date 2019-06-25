<?php

namespace app\Interfaces;

/**
 * Interface to manipulate of tasks.
 *
 * @author     MrDigger <mrdigger@mail.ru>
 * @copyright  © SAD-Systems [http://sad-systems.ru], 2019
 * @created_on 25.06.2019
 */
interface ITaskService
{
    /**
     * Constructor.
     *
     * @param IStorage $storage The storage to manipulate the data.
     */
    public function __construct(IStorage $storage);

    /**
     * Returns a list of tasks.
     *
     * @param int   $offset
     * @param int   $limit
     * @param array $order
     *
     * @return array
     */
    public function getTasks(int $offset = 0, int $limit = 3, array $order = []): array;

    /**
     * Returns the total count of tasks.
     *
     * @return int
     */
    public function getTaskTotalCount(): int;

    /**
     * Creates a new task.
     *
     * @param string $text
     * @param string $email
     * @param string $name
     * @param bool   $status
     *
     * @return null|string
     */
    public function createNewTask(string $text, string $email, string $name = '',  bool $status = false): ?string;

    /**
     * Edit the existed task.
     *
     * @param string $id
     * @param string $text
     * @param bool   $status
     *
     * @return bool
     */
    public function editExistedTask(string $id, string $text, bool $status = false): bool;
}