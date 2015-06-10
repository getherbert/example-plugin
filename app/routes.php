<?php

namespace ApiPosts;

/* @var \Herbert\Framework\Router $router */

/*
 * Returns a list of posts, paginated using Page variable
 */
$router->get([
    'as' => 'getPosts',
    'uri' => '/api/posts',
    'uses' => __NAMESPACE__.'\Controllers\ApiController@posts',
]);

/*
 * Returns a single post - requires an ID
 */
$router->get([
    'as' => 'getSinglePost',
    'uri' => '/api/post/{id}',
    'uses' => __NAMESPACE__.'\Controllers\ApiController@post',
]);

/*
 * Deletes a single post - requires an ID
 */
$router->delete([
    'as' => 'deletePost',
    'uri' => '/api/post/{id}',
    'uses' => __NAMESPACE__.'\Controllers\ApiController@deletePost',
]);
