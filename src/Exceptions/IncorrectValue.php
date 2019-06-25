<?php

namespace app\Exceptions;

use Throwable;
use GraphQL\Error\ClientAware;

/**
 * Exception "Value is incorrect"
 *
 * @author     MrDigger <mrdigger@mail.ru>
 * @copyright  © SAD-Systems [http://sad-systems.ru], 2019
 * @created_on 25.06.2019
 */
class IncorrectValue extends \Exception implements ClientAware
{
    /**
     * IncorrectValue constructor.
     *
     * @param string $message
     * @param int    $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = '', int $code = -2, Throwable $previous = null)
    {
        parent::__construct('Incorrect value' . ($message ? ' of: ' . $message : ''), $code, $previous);
    }

    /**
     * Returns true when exception message is safe to be displayed to a client.
     *
     * @return bool
     *
     * @api
     */
    public function isClientSafe()
    {
        return true;
    }

    /**
     * Returns string describing a category of the error.
     *
     * Value "graphql" is reserved for errors produced by query parsing or validation, do not use it.
     *
     * @return string
     *
     * @api
     */
    public function getCategory()
    {
        return 'access';
    }
}