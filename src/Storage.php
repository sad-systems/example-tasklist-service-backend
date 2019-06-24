<?php
/**
 * PDO Storage class
 *
 * User: Digger
 * Date: 22.06.2019
 * Time: 17:47
 */

namespace app;

class Storage
{
    private $connector;
    private $limitMax = 100;

    public function __construct(array $config)
    {
        $this->connector = new \PDO("{$config['dbtype']}:host={$config['host']};dbname={$config['database']}", $config['username'], $config['password']);
        $this->connector->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
        $statement = $this->connector->prepare("SET NAMES 'utf8'");
        $statement->execute();
        $this->limitMax = $config['limitmax'] ?? $this->limitMax;
    }

    /**
     * For SELECT
     *
     * @param string $query
     * @param array $params
     * @param array $order
     * @param int $offset
     * @param int $limit
     *
     * @return array
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
     * For INSERT, UPDATE DELETE
     *
     * @param string $query
     * @param array $params
     *
     * @return \PDOStatement
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
     * Returns the ID of the last inserted row or sequence value
     *
     * @return string
     */
    public function getLastInsertId(): string
    {
        return $this->connector->lastInsertId();
    }

    /**
     * Helper to obtain the LIMIT string
     *
     * @param int $offset
     * @param int $limit
     *
     * @return string
     */
    protected function getLimit(int $offset, int $limit): string
    {
        return " LIMIT {$offset}, " . ($limit > 0 && $limit < $this->limitMax ? $limit : $this->limitMax);
    }

    /**
     * Helper to obtain the ORDER BY string
     *
     * @param array $orderBy An array of: [ ['field' => ..., 'direction' => asc|desc ], ... ]
     *
     * @return string
     */
    protected function getOrderByString(array $orderBy): string
    {
        $orderByString = implode(',', array_map(function($item){
            return $item['field'] . " " . $item['direction'];
        }, $orderBy));

        return  $orderByString ? ' ORDER BY ' . $orderByString : '';
    }

}