<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Livewire\{Component, WithPagination};
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Index extends Component
{
    use WithPagination;
    public ?string $search = null;

    public function render(): View
    {
        return view('livewire.contacts.index');
    }

    #[Computed]
    public function contacts(): LengthAwarePaginator
    {
        return Contact::query()
            ->select('id', 'name', 'email', 'phone', 'city', 'state')
            ->when(
                $this->search,
                fn (Builder $q) => $q->where(
                    fn (Builder $q) => $q->where('name', 'like', "%{$this->search}%")
                                        ->orWhere('email', 'like', "%{$this->search}%")
                                        ->orWhere('phone', 'like', "%{$this->search}%")
                                        ->orWhere('city', 'like', "%{$this->search}%")
                )
            )
            ->latest()
            ->paginate(10);
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }
}
