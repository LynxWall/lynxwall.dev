<?php
/**
 * Services are globally registered in this file
 *
 * @var \Phalcon\Config $config
 */

use Phalcon\Loader;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Di\FactoryDefault;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;

    /**
 * The FactoryDefault Dependency Injector automatically registers the right services to provide a full stack framework
 */
$di = new FactoryDefault();

// initialize an autoloader for helpers
$loader = new Loader();
$loader->registerNamespaces(array(
    'Lynxwall\Shared\Helpers' => __DIR__ . '/../apps/shared/helpers/',
))->register();


/**
 * Registering a router
 */
$di->set('router', function () {
    $router = new Router();
    $router->setDefaultModule('frontend');

    // routes need to be loaded before the application
    // and modules for everything to work
    $helper = new Lynxwall\Shared\Helpers\Utils();
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
