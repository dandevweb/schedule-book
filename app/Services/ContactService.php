<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ContactService
{
    public function list(
        array $columns = [],
        ?string $search = null,
        ?int $perPage = 10
    ): LengthAwarePaginator {
        return Contact::query()
            ->when(!empty($columns), fn (Builder $q) => $q->select($columns))
            ->when(
                $search,
                fn (Builder $q) => $q->where(
                    fn (Builder $q) => $q->where('name', 'like', "%{$search}%")
                                        ->orWhere('email', 'like', "%{$search}%")
                                        ->orWhere('phone', 'like', "%{$search}%")
                                        ->orWhere('city', 'like', "%{$search}%")
                )
            )
            ->latest()
            ->paginate($perPage);
    }

    public function save(array $data): Contact
    {
        $id = $data['id'] ?? null;
        unset($data['id']);

        return Contact::updateOrCreate([
            'id' => $id
        ], $data);
    }

    public function find(int $id): Contact
    {
        return Contact::findOrFail($id);
    }

    public function delete(int $id): void
    {
        Contact::findOrFail($id)->delete();
    }
}
