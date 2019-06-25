<?php

namespace app\Storages;

use app\Interfaces\IStorage;

/**
 * PDO storage adapter.
 *
 * The class to manipulate with databases connected through the PDO driver.
 *
 * @author     MrDigger <mrdigger@mail.ru>
 * @copyright  © SAD-Systems [http://sad-systems.ru], 2019
 * @created_on 25.06.2019
 */
class PdoStorage implements IStorage
{
    /**
     * The current PDO instance
     * @var \PDO $connector
     */
    protected $connector;

    /**
     * The maximum row count by default.
     * @var int $limitMax
     */
    protected $limitMax = 100;

    /**
     * PdoStorage constructor.
     *
     * @param array $config An array of database communication params:
     * ~~~
     *      [
     *          'dbtype'   =>
     *          'host'     =>
     *          'database' =>
     *          'username' =>
     *          'password' =>
     *          'limitmax' => the maximum row count is possible for any fetch requests
     *      ]
     * ~~~
     */
    public function __construct(array $config)
    {
        $this->connector = new \PDO("{$config['dbtype']}:host={$config['host']};dbname={$config['database']}", $config['username'], $config['password']);
        $this->connector->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
        $statement = $this->connector->prepare("SET NAMES 'utf8'");
        $statement->execute();
        $this->limitMax = $config['limitmax'] ?? $this->limitMax;
    }

    /**
     * For SQL SELECT query.
     *
     * @param string $query  SQL SELECT query string with params templates ( `?` or `:name` ).
     * @param array  $params The query params.
     * @param array  $order  The query ORDER BY statement as an array of structure: [ ['field' => ..., 'direction' => asc|desc ], ... ].
     * @param int    $offset Value of the result limitation offset.
     * @param int    $limit  Value of the result limitation of maximum row count.
     *
     * @return array An array of objects are fetched from database.
     *
     * @throws \Exception
     */
    public function fetch(string $query, array $params = [], array $order = [], int $offset = 0, int $limit = 3): array
    {
        $statement = $this->connector->prepare($query . $this->getOrderByString($order) . $this->getLimit($offset, $limit));

        if (!$statement->execute($params)) {
            throw new \Exception( print_r($statement->errorInfo(), 1) );
        }

        return $statement->fetchAll();
    }

    /**
     * For SQL INSERT, UPDATE DELETE query.
     *
     * @param string $query  SQL INSERT, UPDATE or DELETE query string with params templates ( `?` or `:name` ).
     * @param array  $params The query params.
     *
     * @return \PDOStatement The result statement.
     *
     * @throws \Exception
     */
    public function execute(string $query, array $params = []): \PDOStatement
    {
        $statement = $this->connector->prepare($query);

        if (!$statement->execute($params)) {
            throw new \Exception( print_r($statement->errorInfo(), 1) );
        }

        return $statement;
    }

    /**
     * @inheritdoc
     */
    public function getLastInsertId(): string
    {
        return $this->connector->lastInsertId();
    }

    /**
     * Helper to obtain the LIMIT string.
     *
     * @param int $offset Value of the result limitation offset.
     * @param int $limit  Value of the result limitation of maximum row count.
     *
     * @return string 'LIMIT ... ' SQL statement.
     */
    protected function getLimit(int $offset, int $limit): string
    {
        return " LIMIT {$offset}, " . ($limit > 0 && $limit < $this->limitMax ? $limit : $this->limitMax);
    }

    /**
     * Helper to obtain the ORDER BY string.
     *
     * @param array $orderBy An array of: [ ['field' => ..., 'direction' => asc|desc ], ... ]
     *
     * @return string 'ORDER BY ... ' SQL statement.
     */
    protected function getOrderByString(array $orderBy): string
    {
        $orderByString = implode(',', array_map(function($item){
            return $item['field'] . " " . $item['direction'];
        }, $orderBy));

        return  $orderByString ? ' ORDER BY ' . $orderByString : '';
    }

}