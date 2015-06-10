<?php


return [

    /*
     * The Herbert version constraint.
     */
    'constraint' => '~0.9.7',

    /*
     * The tables to manage.
     */
    'tables' => [
        'ap_access' => 'ApiPosts\Tables\Access',
    ],

    /*
     * Auto-load all required files.
     */
    'requires' => [
        __DIR__.'/app/metaBoxes.php',
    ],

    /*
     * The routes to auto-load.
     */
    'routes' => [
        'ApiPosts' => __DIR__.'/app/routes.php',
    ],

    /*
     * The panels to auto-load.
     */
    'panels' => [
        'ApiPosts' => __DIR__.'/app/panels.php',
    ],

    /*
     * The APIs to auto-load.
     */
    'apis' => [
        'apiPosts' => __DIR__.'/app/api.php',
    ],

    /*
     * The view paths to register.
     *
     * E.G: 'MyPlugin' => __DIR__ . '/views'
     * can be referenced via @MyPlugin/
     * when rendering a view in twig.
     */
    'views' => [
        'ApiPosts' => __DIR__.'/resources/views',
    ],

    /*
     * The asset path.
     */
    'assets' => '/resources/assets/',

];
