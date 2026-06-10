# Nave Cadastros ISS

## Visão geral
`nave-cadastros-iss` é um pacote Laravel/PHP para integrar com a API de Cadastros da Nave.

O pacote expõe um client com facade e resources para consulta e atualização de empreendimentos e opções de compra.

## Requisitos
- PHP 8.1+
- Composer 2
- Laravel compatível com `illuminate/*` 8 a 12
- Acesso à API do Produto e ao token de integração, quando usado em uma aplicação

## Acesso a repositórios privados
Este pacote é consumido como repositório privado via `repositories` nos projetos Laravel clientes.

### Projeto cliente

Adicione o repositório no `composer.json` da aplicação:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/appnave/nave-cadastros-iss.git"
    }
  ],
  "require": {
    "appnave/nave-cadastros-iss": "dev-master"
  }
}
```

Se preferir usar SSH:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "git@github.com:appnave/nave-cadastros-iss.git"
    }
  ]
}
```

Local:

```bash
export COMPOSER_AUTH='{"github-oauth":{"github.com":"SEU_TOKEN_DE_LEITURA"}}'
composer install
```

GitHub Actions:

```yaml
env:
  COMPOSER_AUTH: ${{ secrets.COMPOSER_AUTH }}
```

Se usar GitHub privado, o token precisa ter permissão de leitura no repositório. Em outros hosts, ajuste o JSON de `COMPOSER_AUTH` com as credenciais correspondentes.

## Instalação local
```bash
git clone git@github.com:appnave/nave-cadastros-iss.git
cd nave-cadastros-iss
composer install
```

Em uma aplicação Laravel consumidora, publique a configuração do pacote:

```bash
php artisan vendor:publish --provider="Bildvitta\\IssProduto\\IssProdutoServiceProvider" --tag="iss-produto-config"
```

Variáveis de ambiente usadas pelo pacote:

```dotenv
MS_PRODUTO_BASE_URI=https://api-dev-produto.nave.dev
MS_PRODUTO_FRONT_URI=https://develop.produto.nave.dev
MS_PRODUTO_API_PREFIX=/api

MS_PRODUTO_DB_URL=
MS_PRODUTO_DB_HOST=
MS_PRODUTO_DB_PORT=
MS_PRODUTO_DB_DATABASE=
MS_PRODUTO_DB_USERNAME=
MS_PRODUTO_DB_PASSWORD=
```

Exemplo de uso:

```php
use Bildvitta\IssProduto\IssProduto;

$client = new IssProduto('seu-jwt');

$empreendimentos = $client->realStateDevelopment()->search([
    'name' => 'Exemplo',
]);

$empreendimento = $client->realStateDevelopment()->find('uuid');
$opcao = $client->buyingOptions()->find('uuid');
```

## Comandos úteis
```bash
composer test
composer check-style
composer fix-style
composer psalm
composer test-coverage
```

## Documentação da API
Não há Swagger/OpenAPI versionado neste repositório.

Integrações disponíveis no pacote:
- `realStateDevelopment()->search()`
- `realStateDevelopment()->find()`
- `realStateDevelopment()->update()`
- `realStateDevelopment()->mirrors()->reflectorUnities()`
- `buyingOptions()->search()`
- `buyingOptions()->find()`

## Convenções
- Estilo de código com `php-cs-fixer` e regras PSR-2
- O projeto segue SemVer para mudanças públicas
- Mudanças de comportamento devem vir com testes
- A licença do projeto é MIT
