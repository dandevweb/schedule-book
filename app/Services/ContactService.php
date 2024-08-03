<?php

namespace App\Services;

use App\Models\Contact;

class ContactService
{
    public function save(array $data): Contact
    {
        $id = $data['id'] ?? null;
        unset($data['id']);

        return Contact::updateOrCreate([
            'id' => $id
        ], $data);
    }
}
