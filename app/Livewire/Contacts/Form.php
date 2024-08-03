<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Livewire\Component;
use Illuminate\View\View;
use App\Services\{ContactService, ViaCepService};
use App\Http\Requests\ContactRequest;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Form extends Component
{
    use LivewireAlert;

    public ?int $id              = null;
    public ?string $name         = null;
    public ?string $email        = null;
    public ?string $phone        = null;
    public ?string $zip_code     = null;
    public ?string $address      = null;
    public ?string $neighborhood = null;
    public ?string $number       = null;
    public ?string $complement   = null;
    public ?string $city         = null;
    public ?string $state        = null;
    public ?Contact $contact     = null;

    protected function rules(): array
    {
        return (new ContactRequest())->rules();
    }

    public function mount(): void
    {
        $this->setContact();
    }

    public function render(): View
    {
        return view('livewire.contacts.form');
    }

    public function save(): void
    {
        $this->validate();

        (new ContactService())->save($this->toArray());

        $this->flash('success', 'Contato salvo com sucesso!', redirect: route('contacts'));
    }

    public function searchZipCode(): void
    {
        $response = (new ViaCepService())->handle($this->zip_code);

        $this->address      = $response['address'] ?? null;
        $this->neighborhood = $response['neighborhood'] ?? null;
        $this->city         = $response['city'] ?? null;
        $this->state        = $response['state'] ?? null;
    }

    private function toArray(): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'email'        => $this->email,
            'phone'        => $this->phone,
            'zip_code'     => $this->zip_code,
            'address'      => $this->address,
            'neighborhood' => $this->neighborhood,
            'number'       => $this->number,
            'complement'   => $this->complement,
            'city'         => $this->city,
            'state'        => $this->state,
        ];
    }

    private function setContact(): void
    {
        $this->id           = $this->contact?->id;
        $this->name         = $this->contact?->name;
        $this->email        = $this->contact?->email;
        $this->phone        = $this->contact?->phone;
        $this->zip_code     = $this->contact?->zip_code;
        $this->address      = $this->contact?->address;
        $this->neighborhood = $this->contact?->neighborhood;
        $this->number       = $this->contact?->number;
        $this->complement   = $this->contact?->complement;
        $this->city         = $this->contact?->city;
        $this->state        = $this->contact?->state;
    }
}
