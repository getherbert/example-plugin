<?php

namespace ApiPosts\Models\Scopes;

use Illuminate\Database\Eloquent\ScopeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ApiEnabledScope implements ScopeInterface
{
    /**
     * The ApiEnabled column.
     *
     * @var string
     */
    protected static $apiEnabledScopeColumn;

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model   $model
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->whereHas('meta', function ($query) {
            $query->where('meta_key', '_apiposts_enable_api_key')
                ->where('meta_value', 'yes');

            self::$apiEnabledScopeColumn = $query->toSql();
        });
    }

    /**
     * Remove the scope from the given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model   $model
     */
    public function remove(Builder $builder, Model $model)
    {
        $query = $builder->getQuery();

        $wheres = [
            'type' => 'Basic',
            'column' => 'post_type',
            'operator' => '>=',
            'value' => 'form',
            'boolean' => 'and',
        ];

        foreach ((array) $query->wheres as $key => $where) {
            if ($where['type'] !== 'Basic'
                || (string) $where['column'] !== '('.self::$apiEnabledScopeColumn.')'
                || $where['operator'] !== '>='
                || (int) $where['value'] !== 1
                || $where['boolean'] !== 'and') {
                continue;
            }

            unset($query->wheres[$key]);

            $query->wheres = array_values($query->wheres);
        }
    }
}
