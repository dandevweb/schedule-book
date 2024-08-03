<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\{Builder, Model, Scope};

class UserScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $builder->whereUserId(user()?->id);
    }
}
