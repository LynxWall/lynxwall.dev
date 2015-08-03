<?php

/**
 * Register application modules
 */
$application->registerModules(array(
    'admin' => array(
        'className' => 'Lynxwall\Admin\Module',
        'path' => __DIR__ . '/../apps/admin/Module.php'
    ),
    'frontend' => array(
        'className' => 'Lynxwall\Frontend\Module',
        'path' => __DIR__ . '/../apps/frontend/Module.php'
    )
));
