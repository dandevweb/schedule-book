# Agenda de Contatos

Este projeto é uma aplicação desenvolvida em Laravel para gerenciar uma agenda de contatos. O sistema permite realizar operações CRUD (Criar, Ler, Atualizar e Deletar) em contatos, com suporte para busca, filtragem e paginação.

A aplicação pode ser acessada diretamente pelo navegador, oferecendo uma interface amigável para gerenciamento dos contatos. Além disso, foram disponibilizados endpoints para integração com outros sistemas, facilitando a automação e a integração com outras plataformas.

Para detalhes sobre como usar os endpoints da API, consulte a [DOCUMENTAÇÃO DA API](https://documenter.getpostman.com/view/22300616/2sA3rwMtqB).

## Features

-   Listar Contatos: Visualize uma lista de contatos com suporte para paginação e filtragem.
-   Criar Contato: Adicione novos contatos à agenda com detalhes como nome, e-mail, telefone e endereço.
-   Atualizar Contato: Atualize informações de contatos existentes.
-   Excluir Contato: Remova contatos da agenda.
-   Busca e Filtros: Pesquise contatos por nome, e-mail, telefone e cidade.
-   Integração com API Via Cep: Obtém informações de endereço baseado no CEP.

## Tecnologias utilizadas

-   PHP 8.3
-   Laravel 11
-   Livewire 3
-   Laravel Breeze
-   Pest
-   MySql

## Requerimentos

Necessário sistema operacional macOS, Linux ou Windows (via [WSL2](https://docs.microsoft.com/en-us/windows/wsl/about)) e Docker.

## Rodando localmente

Clone o projeto

```bash
git clone https://github.com/dandevweb/schedule-book.git

```

Entre no diretório do projeto

```bash
cd schedule-book

```

Crie o arquivo .env a partir do arquivo .env.example

```bash
cp .env.example .env
```

Com o Docker "startado", suba o container

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

Inicie o servidor

```bash
./vendor/bin/sail up -d
```

Crie um alias para facilitar os comandos do Sail

```bash
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

Gere a chave da aplicação

```bash
sail artisan key:generate
```

Execute as migrations

```bash
sail artisan migrate
```

Execute os seeders

```bash
sail artisan db:seed
```

Instale as dependências javascript

```bash
sail npm install
```

Compile os assets

```bash
sail npm run dev
```

Acesse o projeto em:

    - http://localhost

## Testes

Para rodar os testes, execute o comando:

```bash
sail test
```

## Usuário para login

    -   E-mail: test@example.com
    -   Senha: password

É possível criar novos usuários em [/register](http://localhost/register)

## Libs utilizadas

**PHP composer**

-   [laravel-pt-BR-localization](https://github.com/lucascudo/laravel-pt-BR-localization)

-   [Breeze Bootstrap](https://github.com/guizoxxv/laravel-breeze-bootstrap)

-   [Livewire Alert](https://github.com/jantinnerezo/livewire-alert)
