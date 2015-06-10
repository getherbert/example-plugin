<?php

namespace ApiPosts;

/* @var \Herbert\Framework\Panel $panel */

/*
 * Adds a panel to manage allowed IP addresses
 */
$panel->add([
    'type' => 'panel',
    'as' => 'mainPanel',
    'title' => 'Api Posts',
    'slug' => 'apiposts-index',
    'icon' => 'dashicons-chart-area',
    'uses' => __NAMESPACE__.'\Controllers\AdminController@index',
    'post.add' => __NAMESPACE__.'\Controllers\AdminController@add',
    'post.delete' => __NAMESPACE__.'\Controllers\AdminController@delete',
]);
