<?php

namespace Lynxwall\Admin;

use Phalcon\Mvc\Router;
use Phalcon\Mvc\Dispatcher;
use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;


class Module implements ModuleDefinitionInterface
{
    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {

        $loader = new Loader();

        $loader->registerNamespaces(array(
            'Lynxwall\Admin\Controllers' => __DIR__ . '/controllers/',
            'Lynxwall\Admin\Models' => __DIR__ . '/models/',
        ), true)->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        /**
         * Read configuration
         */
        $config = include __DIR__  . "/config/config.php";

        // Registering a dispatcher
        $di->set('dispatcher', function () {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('Lynxwall\Admin\Controllers');
            return $dispatcher;
        });

        // Registering the view component
        $di->set('view', function () use($config) {
            $view = new View();

            $view->setViewsDir($config->application->viewsDir);
            $view->setLayoutsDir('../../shared/layouts/');
            $view->setTemplateAfter('main');

            $view->registerEngines(array(
                '.volt' => function ($view, $di) use ($config) {

                    $volt = new VoltEngine($view, $di);

                    $volt->setOptions(array(
                        'compiledPath' => $config->application->cacheDir,
                        'compiledSeparator' => '_'
                    ));

                    return $volt;
                },
                '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
            ));

            return $view;
        });

         /**
         * Database connection is created based in the parameters defined in the configuration file
         */
        $di['db'] = function () use ($config) {
            return new DbAdapter($config->database->toArray());
        };
    }
}
