<?php

namespace ApiPosts\Controllers;

use Herbert\Framework\Http;
use Herbert\Framework\Exceptions\HttpErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ApiPosts\Models\Access;

/**
 * Class AdminController.
 */
class AdminController
{
    /**
     * Returns the main view of the plugin.
     *
     * @return string
     */
    public function index()
    {
        return view('@ApiPosts/admin/index.twig', [
            'addresses' => Access::all(),
        ]);
    }

    /**
     * Add a new IP address.
     *
     * @param Http $http
     *
     * @return \Herbert\Framework\Response
     */
    public function add(Http $http)
    {
        if ($http->has('address')) {
            Access::create(['address' => $http->get('address')]);
        }

        return redirect_response(panel_url('ApiPosts::mainPanel'));
    }

    /**
     * Delete an IP address.
     *
     * @param Http $http
     *
     * @return \Herbert\Framework\Response
     *
     * @throws HttpErrorException
     */
    public function delete(Http $http)
    {
        try {
            $address = Access::findOrFail($http->get('id'));
        } catch (ModelNotFoundException $e) {
            throw new HttpErrorException(404, "It looks like that address doesn't exist.");
        }

        $address->delete();

        return redirect_response(panel_url('ApiPosts::mainPanel'));
    }
}
