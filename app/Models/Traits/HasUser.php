<?php

declare(strict_types=1);

namespace App\Models\Traits;

use App\Models\User;
use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasUser
{
    protected static function bootHasUser(): void
    {
        static::addGlobalScope(new UserScope());

        static::creating(function ($model) {
            $model->user_id = user()?->id;
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
