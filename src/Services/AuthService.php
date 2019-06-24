<?php
/**
 * Authentication service
 *
 * User: Digger
 * Date: 22.06.2019
 * Time: 16:01
 */

namespace app\Services;

use app\Exceptions\NotEnoughPrivileges;

class AuthService
{
    // --- For demo version:
    private static $adminToken = 'FGHGFTRE79G632XDROO000123GDERF';
    private static $adminUser  = 'admin';
    private static $adminPass  = '123';

    /**
     * Returns user's access token for registered user
     *
     * @param string $user
     * @param string $password
     *
     * @return null|string
     */
    public function getAccessToken(string $user, string $password): ?string
    {
        // --- For demo version:
        return $user === static::$adminUser && $password === static::$adminPass ? static::$adminToken : null;
    }

    /**
     * Checks if token is valid
     *
     * @param string $accessToken
     *
     * @throws NotEnoughPrivileges
     */
    public function checkAccess(string $accessToken)
    {
        // --- For demo version:
        if ($accessToken !== static::$adminToken) {
            throw new NotEnoughPrivileges();
        }
    }

}