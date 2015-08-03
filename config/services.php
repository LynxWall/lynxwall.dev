<?php
/**
 * Services are globally registered in this file
 *
 * @var \Phalcon\Config $config
 */

use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Di\FactoryDefault;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;

// Load the common helpers class
require __DIR__ . '/../apps/common/Helpers.php';

    /**
 * The FactoryDefault Dependency Injector automatically registers the right services to provide a full stack framework
 */
$di = new FactoryDefault();

/**
 * Registering a router
 */
$di->set('router', function () {
    $router = new Router();
    $router->setDefaultModule('frontend');

    // routes need to be loaded before the application
    // and modules for everything to work
    $helper = new \Lynxwall\common\Helpers();
    $helper->addRoutes($router, 'admin', 'Lynxwall\Admin\Controllers');
    $helper->addRoutes($router, 'frontend', 'Lynxwall\Frontend\Controllers');

    return $router;
});

/**
 * The URL component is used to generate all kinds of URLs in the application
 */
$di->set('url', function () {
    $url = new UrlResolver();
    $url->setBaseUri('/');

    return $url;
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Starts the session the first time some component requests the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});
