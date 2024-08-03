<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">


                    <form wire:submit.prevent="save">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input type="text" class="form-control" id="name"
                                wire:model="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email"
                                wire:model="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Telefone:</label>
                            <input type="text" class="form-control" id="phone"
                                wire:model="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="zip_code">CEP:</label>
                            <input type="text" class="form-control" id="zip_code"
                                wire:model="zip_code">
                        </div>
                        <div class="form-group">
                            <label for="address">Endereço:</label>
                            <input type="text" class="form-control" id="address"
                                wire:model="address" readonly>
                        </div>
                        <div class="form-group">
                            <label for="number">Número:</label>
                            <input type="text" class="form-control" id="number"
                                wire:model="number">
                        </div>
                        <div class="form-group">
                            <label for="complement">Complemento:</label>
                            <input type="text" class="form-control" id="complement"
                                wire:model="complement">
                        </div>
                        <div class="form-group">
                            <label for="city">Cidade:</label>
                            <input type="text" class="form-control" id="city"
                                wire:model="city" readonly>
                        </div>
                        <div class="form-group">
                            <label for="state">Estado:</label>
                            <input type="text" class="form-control" id="state"
                                wire:model="state" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>

                        @if (session()->has('message'))
                            <div class="alert alert-success mt-3">
                                {{ session('message') }}
                            </div>
                        @endif
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
