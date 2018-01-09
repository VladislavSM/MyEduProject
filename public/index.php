<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23.04.17
 * Time: 18:17
 */

/**
 * Code : require_once '../core/SiteError.php';
 *        $serr = new SiteError();
 *        $serr->siteErrors();
 * you need to connect when the site is uploaded to the hosting.
 */
//require_once '../core/SiteError.php';
//$serr = new SiteError();
//$serr->siteErrors();

use core\Bootstrap;

define('DS', DIRECTORY_SEPARATOR);
define('APP_PATH', '..' . DS . 'application' . DS);

require(__DIR__ . DS . '..' . DS . 'autoload.php');


$bootstrap = Bootstrap::getInstance();



