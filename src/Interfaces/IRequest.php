<?php

namespace app\Interfaces;

/**
 * Interface to parse input request
 *
 * @author     MrDigger <mrdigger@mail.ru>
 * @copyright  © SAD-Systems [http://sad-systems.ru], 2019
 * @created_on 25.06.2019
 */
interface IRequest
{
    /**
     * Parses the input request data.
     *
     * @return array The array with parsed input parameters.
     */
    public function getInputParams(): array;
}