<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id ?? null,
            'name'  => $this->name ?? null,
            'email' => $this->email ?? null,
        ];
    }
}
