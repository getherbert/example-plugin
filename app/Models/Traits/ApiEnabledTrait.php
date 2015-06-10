<?php

namespace ApiPosts\Models\Traits;

use ApiPosts\Models\Scopes\ApiEnabledScope;

trait ApiEnabledTrait
{
    /**
     * Boots the ApiEnabledTrait.
     */
    public static function bootApiEnabledTrait()
    {
        static::addGlobalScope(new ApiEnabledScope());
    }
}
