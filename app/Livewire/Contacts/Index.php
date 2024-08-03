<?php

namespace App\Livewire\Contacts;

use Illuminate\View\View;
use App\Services\ContactService;
use Livewire\Attributes\{Computed, On};
use Livewire\{Component, WithPagination};
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Index extends Component
{
    use WithPagination;
    use LivewireAlert;

    public ?string $search = null;
    public ?int $modelId   = null;

    public function render(): View
    {
        return view('livewire.contacts.index');
    }

    #[Computed]
    public function contacts(): LengthAwarePaginator
    {
        return  (new ContactService())->list(
            columns: ['id', 'name', 'email', 'phone', 'city'],
            search: $this->search,
            perPage: 10
        );
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function tryDelete(int $id): void
    {
        $this->modelId = $id;
        $this->confirm('Tem certeza?', deleteOptions());
    }

    #[On('confirmed')]
    public function delete(): void
    {
        (new ContactService())->delete($this->modelId);

        $this->flash('success', 'Contato excluído com sucesso!', redirect: route('contacts'));
    }
}
