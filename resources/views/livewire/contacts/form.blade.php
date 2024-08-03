<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex w-100 justify-content-between align-items-center">
                    <span>Criar Contato</span>
                    <a href="{{ route('contacts') }}" class="btn btn-primary">Voltar</a>
                </div>

                <div class="card col-md-8 mx-auto my-4">
                    <div class="px-5 py-4">
                        <form wire:submit.prevent="save" class="row">

                            <div class="form-group col-md-6 mb-3">
                                <label for="name">Nome:</label>
                                <input type="text" class="form-control" id="name"
                                    wire:model.live.debounce="name">
                                <x-input-error for="name" />

                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email"
                                    wire:model.live.debounce="email">
                                <x-input-error for="email" />
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label for="phone">Telefone:</label>
                                <input type="text" class="form-control" id="phone"
                                    x-mask="(99) 99999-9999" wire:model.live.debounce="phone">
                                <x-input-error for="phone" />
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label for="zip_code">CEP:</label>
                                <input type="text" class="form-control" id="zip_code"
                                    x-mask="99999-999" wire:model.live.debounce="zip_code"
                                    x-on:blur="$wire.searchZipCode">
                                <x-input-error for="zip_code" />
                            </div>

                            <div class="form-group mb-3">
                                <label for="address">Endereço:</label>
                                <input type="text" class="form-control" id="address"
                                    wire:model.live.debounce="address">
                                <x-input-error for="address" />
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label for="neighborhood">Bairro:</label>
                                <input type="text" class="form-control" id="neighborhood"
                                    wire:model.live.debounce="neighborhood">
                                <x-input-error for="neighborhood" />
                            </div>

                            <div class="form-group col-md-3 mb-3">
                                <label for="number">Número:</label>
                                <input type="text" class="form-control" id="number"
                                    wire:model.live.debounce="number">
                                <x-input-error for="number" />
                            </div>

                            <div class="form-group col-md-3 mb-3">
                                <label for="complement">Complemento:</label>
                                <input type="text" class="form-control" id="complement"
                                    wire:model.live.debounce="complement">
                                <x-input-error for="complement" />
                            </div>

                            <div class="form-group col-md-8">
                                <label for="city">Cidade:</label>
                                <input type="text" class="form-control" id="city"
                                    wire:model.live.debounce="city">
                                <x-input-error for="city" />
                            </div>

                            <div class="form-group col-md-4 mb-2">
                                <label for="city">Estado:</label>
                                <select class="form-select" wire:model.live.debounce='state'>
                                    <option selected>Selecione</option>
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espírito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                    <option value="EX">Estrangeiro</option>
                                </select>
                                <x-input-error for="state" />
                            </div>

                            <div class="col-md-10"></div>
                            <button class="btn btn-primary col-md-2 mt-2">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
