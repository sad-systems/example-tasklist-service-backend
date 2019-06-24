<?php
/**
 * Service to manipulate of tasks
 *
 * User: Digger
 * Date: 22.06.2019
 * Time: 14:45
 */

namespace app\Services;

use app\Storage;

class TaskService
{

    private $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    /**
     * Returns a list of tasks
     *
     * @param int $offset
     * @param int $limit
     * @param array $order
     *
     * @return array
     *
     * @throws \Exception
     */
    public function getTasks(int $offset = 0, int $limit = 3, array $order = []): array
    {
        if (empty($order)) $order = [ ['field' => 'id', 'direction' => 'asc'] ]; //<--- Order by default to prettify JOIN results
        $query = "SELECT t.`id` as id, `text`, `status`, `email`, `name` FROM `tasks` as t LEFT OUTER JOIN `users` USING (`email`)";
        return $this->storage->fetch($query, [], $order, $offset, $limit);
    }

    /**
     * Returns the total count of tasks
     *
     * @return int
     *
     * @throws \Exception
     */
    public function getTaskTotalCount(): int
    {
        $query = "SELECT count(*) as `count` FROM `tasks`";
        $result = $this->storage->fetch($query, []);
        return (int) $result[0]->count;
    }

    /**
     * Creates a new task
     *
     * @param string $text
     * @param string $email
     * @param string $name
     * @param bool $status
     *
     * @return null|string
     *
     * @throws \Exception
     */
    public function createNewTask(string $text, string $email, string $name = '',  bool $status = false): ?string
    {
        $query = "INSERT INTO `tasks` (`text`, `email`, `status`) VALUES (?, ?, ?)";
        $this->storage->execute($query, [$text, $email, ($status ? 1 : 0)]);
        $id = $this->storage->getLastInsertId();
        $this->updateUser($email, $name);
        return $id;
    }

    /**
     * Edit the existed task
     *
     * @param string $id
     * @param string $text
     * @param bool $status
     * @return bool
     *
     * @throws \Exception
     */
    public function editExistedTask(string $id, string $text, bool $status = false): bool
    {
        $query = "UPDATE `tasks` SET `text` = ?, `status` = ? WHERE id = ?";
        $this->storage->execute($query, [$text, ($status ? 1 : 0), $id]);
        return true;
    }

    /**
     * Updates name of an existed user or create new
     *
     * @param string $email
     * @param string $name
     * @throws \Exception
     */
    protected function updateUser(string $email, string $name = '')
    {
        if (!$name) return;

        $query = "INSERT INTO `users` (`email`, `name`) VALUES (:email, :name)
                  ON DUPLICATE KEY UPDATE `name` = :name";

        $this->storage->execute($query, [':email' => $email, ':name' => $name]);
    }

}