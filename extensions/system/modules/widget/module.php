<?php

use Pagekit\Widget\Event\WidgetListener;

return [

    'name' => 'system/widget',

    'main' => function ($app, $config) {

        $app->subscribe(
            new WidgetListener
        );

        $app['system']->loadControllers($config);

        $app->on('system.admin_menu', function ($event) use ($config) {
            $event->register($config['menu']);
        });

        $app->on('system.permission', function ($event) use ($config) {
            $event->setPermissions($config['name'], $config['permissions']);
        });

    },

    'autoload' => [

        'Pagekit\\Widget\\' => 'src'

    ],

    'controllers' => [

        '@system: /system' => [
            'Pagekit\\Widget\\Controller\\WidgetsController'
        ]

    ],

    'menu' => [

        'system: widgets' => [
            'label'    => 'Widgets',
            'icon'     => 'extensions/system/assets/images/icon-widgets.svg',
            'url'      => '@system/widgets',
            'active'   => '@system/widgets*',
            'access'   => 'system: manage widgets',
            'priority' => 5
        ]

    ],

    'permissions' => [

        'system: manage widgets' => [
            'title' => 'Manage widgets'
        ]

    ]

];