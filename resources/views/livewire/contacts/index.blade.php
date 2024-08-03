<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex w-100 justify-content-between align-items-center">
                    <span>Contatos</span>
                    <div class="col-md-4 d-flex justify-content-end">
                        <input class="form-control" wire:model.live='search' type="search"
                            placeholder="Faça uma busca...">
                    </div>
                    <a href="{{ route('contacts.form') }}" class="btn btn-primary">Criar novo</a>
                </div>
                <div class="card-body pb-0">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Cidade</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($this->contacts as $contact)
                                <tr>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>{{ $contact->city }}</td>
                                    <td>
                                        <a href="{{ route('contacts.form', $contact) }}"
                                            class="btn btn-warning">Editar</a>
                                        <a href="" class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $this->contacts->links('vendor.livewire.bootstrap') }}
                </div>

            </div>
        </div>
    </div>
</div>
