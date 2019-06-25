<?php

namespace app\Interfaces;

/**
 * Interface to create output response
 *
 * @author     MrDigger <mrdigger@mail.ru>
 * @copyright  © SAD-Systems [http://sad-systems.ru], 2019
 * @created_on 25.06.2019
 */
interface IResponse
{
    /**
     * Creates the response structure from exception object.
     *
     * @param \Exception $exception Exception object.
     *
     * @return array An array of response structure.
     */
    public function createError(\Exception $exception): array;

    /**
     * Creates a server response string for an error.
     *
     * @param \Exception $exception Exception object.
     *
     * @return string The response string.
     */
    public function createResponseError(\Exception $exception): string;

    /**
     * Creates a server response string for any data.
     *
     * @param $data mixed
     *
     * @return string
     */
    public function createResponse($data): string;
}