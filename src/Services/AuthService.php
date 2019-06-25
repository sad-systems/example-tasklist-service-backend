<?php

namespace app\Services;

use app\Exceptions\NotEnoughPrivileges;
use app\Interfaces\IAuthService;

/**
 * Authentication service
 *
 * @author     MrDigger <mrdigger@mail.ru>
 * @copyright  © SAD-Systems [http://sad-systems.ru], 2019
 * @created_on 25.06.2019
 */
class AuthService implements IAuthService
{
    // --- For demo version:
    private static $adminToken = 'FGHGFTRE79G632XDROO000123GDERF';
    private static $adminUser  = 'admin';
    private static $adminPass  = '123';

    /**
     * @inheritdoc
     */
    public function getAccessToken(string $user, string $password): ?string
    {
        // --- For demo version:
        return $user === static::$adminUser && $password === static::$adminPass ? static::$adminToken : null;
    }

    /**
     * @inheritdoc
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