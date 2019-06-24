<?php
/**
 * Exception "Value is incorrect"
 *
 * User: Digger
 * Date: 22.06.2019
 * Time: 17:22
 */

namespace app\Exceptions;

use Throwable;
use GraphQL\Error\ClientAware;

class IncorrectValue extends \Exception implements ClientAware
{

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