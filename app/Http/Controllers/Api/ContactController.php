<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\ContactService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactController extends Controller
{
    public function __construct(private ContactService $contactService)
    {
    }

    public function index(Request $request): JsonResource
    {
        $data = $request->validate([
            'columns' => 'array',
            'search'  => 'string',
            'perPage' => 'integer',
        ]);

        $contacts = $this->contactService->list(
            columns: $data['columns'] ?? [],
            search: $data['search'] ?? null,
            perPage: $data['perPage'] ?? null
        );

        return ContactResource::collection($contacts);
    }
}
