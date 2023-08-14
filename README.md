# Backend Laravel de Gerenciamento de Endereços

Este é o backend Laravel para a aplicação de gerenciamento de endereços utilizando Vue 3.

## Pré-requisitos

Certifique-se de ter o PHP e o Composer instalados em seu sistema.

## Configuração

1. Clone este repositório:

```
git clone https://github.com/araodomingosjoao/cep-explorer-api
```

2. Navegue para a pasta do projeto:

```
cd cep-explorer-api
```

3. Instale as dependências:

```
composer install
```

4. Crie o arquivo `.env`:

```
cp .env.example .env
```

5. Configure as informações do banco de dados no arquivo `.env`.

6. Gere a chave de aplicação:

```
php artisan key:generate
```

7. Rode as migrações para criar as tabelas do banco de dados:

```
php artisan migrate
```

8. Inicie o servidor:

```
php artisan serve
```

## Rotas

O backend Laravel possui as seguintes rotas:

- `GET /api/addresses`: Retorna todos os endereços cadastrados.
- `GET /api/addresses/{id}`: Retorna um endereço específico.
- `POST /api/addresses`: Cadastra um novo endereço. (Requer os campos: `postal_code`, `city`, `neighborhood`, `state`)
- `PUT /api/addresses/{id}`: Atualiza um endereço existente. (Requer os mesmos campos do POST)
- `DELETE /api/addresses/{id}`: Remove um endereço existente.

## Contribuição

Sinta-se à vontade para contribuir com melhorias, correções de bugs e novos recursos. Basta fazer um fork deste repositório, criar um branch para sua feature/fix e enviar um pull request.

## Licença

Este projeto está sob a licença [MIT](https://opensource.org/licenses/MIT).