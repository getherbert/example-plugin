Example Plugin: Api Posts
===============

This is an example plugin for Herbert. Remember to run `composer install`

The plugin:
1. Extends the post Publish metebox with an option to enable the api on that post.
2. Adds a panel where you can define IP addresses that are allowed to access the api.
3. Adds routes for the api:
⋅⋅*`/api/posts`
⋅⋅*`/api/posts?page2`
⋅⋅*`/api/post/123`
⋅⋅*`DELETE /api/post/123`


