<?php
/**
 * Application entry point
 */

require_once ("../vendor/autoload.php");

use app\Application;
use app\QueryTypeFactory;
use app\QueryServiceFactory;
use app\Services\Request;
use app\Services\Response;
use app\Storages\PdoStorage;

$storageConfig = require ("../src/Configs/storage.php");

$app = new Application( new Request(), new Response(), new QueryTypeFactory( new QueryServiceFactory( new PdoStorage( $storageConfig ) ) ) );

echo $app->run();