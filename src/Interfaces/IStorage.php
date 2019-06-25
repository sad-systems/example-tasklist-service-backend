<?php

namespace app\Interfaces;

/**
 * Interface to manipulate with a data storage
 *
 * @author     MrDigger <mrdigger@mail.ru>
 * @copyright  © SAD-Systems [http://sad-systems.ru], 2019
 * @created_on 25.06.2019
 */
interface IStorage
{
    /**
     * The query to fetch a data.
     *
     * @param string $query  The query string with params templates.
     * @param array  $params The query params.
     * @param array  $order  The query sort order as an array of structure: [ ['field' => ..., 'direction' => asc|desc ], ... ].
     * @param int    $offset Value of the result limitation offset.
     * @param int    $limit  Value of the result limitation of maximum row count.
     *
     * @return array An array of objects are fetched from database.
     *
     * @throws \Exception
     */
    public function fetch(string $query, array $params = [], array $order = [], int $offset = 0, int $limit = 3): array;

    /**
     * The query to change the data.
     *
     * @param string $query  The query string with params templates.
     * @param array  $params The query params.
     *
     * @return mixed The result statement.
     *
     * @throws \Exception
     */
    public function execute(string $query, array $params = []);

    /**
     * Returns the ID of the last inserted row or sequence value.
     *
     * @return string
     */
    public function getLastInsertId(): string;
}