<?php

namespace ApiPosts\Controllers;

use Herbert\Framework\Http;
use Herbert\Framework\Exceptions\HttpErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ApiPosts\Models\Access;
use ApiPosts\Models\ApiPost;

/**
 * Class ApiController.
 */
class ApiController
{
    /**
     * Number of posts per page.
     *
     * @var int
     */
    protected static $perPage = 10;

    /**
     * Returns a list of posts.
     *
     * @param Http $http
     *
     * @return \Herbert\Framework\Response
     *
     * @throws HttpErrorException
     */
    public function posts(Http $http)
    {
        $this->allowed($http->ip());

        $page = $http->get('page', 1);

        $posts = ApiPost::query()
            ->forPage($page, self::$perPage)
            ->get();

        return json_response($posts);
    }

    /**
     * Returns a specific post based on ID.
     *
     * @param $id
     * @param Http $http
     *
     * @return \Herbert\Framework\Response
     *
     * @throws HttpErrorException
     */
    public function post($id, Http $http)
    {
        $this->allowed($http->ip());

        $post = ApiPost::query()
            ->where('ID', $id)
            ->get();

        return json_response($post);
    }

    /**
     * Deletes a specific post based on ID.
     *
     * @param $id
     * @param Http $http
     *
     * @return \Herbert\Framework\Response
     *
     * @throws HttpErrorException
     */
    public function deletePost($id, Http $http)
    {
        $this->allowed($http->ip());

        $deleted = ApiPost::query()
            ->where('ID', $id)
            ->delete();

        if ($deleted) {
            return json_response(['Success']);
        }

        return response('Nothing deleted', 404);
    }

    /**
     * Checks if the users IP is allowed to access the api.
     *
     * @param $ip
     *
     * @throws HttpErrorException
     */
    protected function allowed($ip)
    {
        try {
            Access::where('address', $ip)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new HttpErrorException(403, 'Forbidden.');
        }
    }
}
