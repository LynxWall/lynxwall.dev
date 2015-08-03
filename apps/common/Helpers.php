<?php
/**
 * Created by PhpStorm.
 * User: Lonnie
 * Date: 8/2/15
 * Time: 12:04 AM
 */

namespace Lynxwall\common;

use Phalcon\Mvc\Router;


class Helpers
{
    public function addRoutes(Router $router, $key, $namespace) {
        $router->add('/'.$key.'/:params', array(
            'namespace' => $namespace,
            'module' => $key,
            'controller' => 'index',
            'action' => 'index',
            'params' => 1
        ))->setName($key);
        $router->add('/'.$key.'/:controller/:params', array(
            'namespace' => $namespace,
            'module' => $key,
            'controller' => 1,
            'action' => 'index',
            'params' => 2
        ));
        $router->add('/'.$key.'/:controller/:action/:params', array(
            'namespace' => $namespace,
            'module' => $key,
            'controller' => 1,
            'action' => 2,
            'params' => 3
        ));

    }
}