<?php

namespace ApiPosts\Models;

use Herbert\Framework\Models\Post;
use ApiPosts\Models\Traits\ApiEnabledTrait;

class ApiPost extends Post
{
    use ApiEnabledTrait;
}
