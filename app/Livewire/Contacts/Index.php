<?php

namespace App\Livewire\Contacts;

use Livewire\{Component, WithPagination};
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use App\Http\Requests\ContactRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Index extends Component
{
    use WithPagination;

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
    public ?string $search       = null;


    protected function rules(ContactRequest $request): array
    {
        return $request->rules();
    }

    public function render(): View
    {
        return view('livewire.contacts.index');
    }

    #[Computed]
    public function contacts(): LengthAwarePaginator
    {
        return user()
            ->contacts()
            ->select('id', 'name', 'email', 'phone', 'city', 'state')
            ->when(
                $this->search,
                fn (Builder $q) => $q->where( /* @phpstan-ignore-line */
                    fn (Builder $q) => $q->where('name', 'like', "%{$this->search}%")
                                        ->orWhere('email', 'like', "%{$this->search}%")
                                        ->orWhere('phone', 'like', "%{$this->search}%")
                                        ->orWhere('city', 'like', "%{$this->search}%")
                )
            )
            ->paginate(10);
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }
}
