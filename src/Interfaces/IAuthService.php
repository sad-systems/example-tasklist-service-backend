<?php

namespace app\Interfaces;

/**
 * Interface of the Authentication service
 *
 * @author     MrDigger <mrdigger@mail.ru>
 * @copyright  © SAD-Systems [http://sad-systems.ru], 2019
 * @created_on 25.06.2019
 */
interface IAuthService
{
    /**
     * Returns user's access token for registered user
     *
     * @param string $user     User's name.
     * @param string $password User's password.
     *
     * @return null|string
     */
    public function getAccessToken(string $user, string $password): ?string;

    /**
     * Checks if token is valid.
     * Must throw NotEnoughPrivileges exception on error.
     *
     * @param string $accessToken
     */
    public function checkAccess(string $accessToken);
}