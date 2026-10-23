# Raia Sports

Loja virtual esportiva desenvolvida em **PHP puro**, sem framework e sem banco de dados tradicional.

- **Aluno(a):** [preencher]
- **Curso/Disciplina:** [preencher]
- **Professor(a):** [preencher]
- **Data:** 21/10/2026

## Sumário

1. [Sobre o projeto](#sobre-o-projeto)
2. [Funcionalidades](#funcionalidades)
3. [Tecnologias](#tecnologias)
4. [Como executar](#como-executar)
5. [Estrutura de pastas](#estrutura-de-pastas)
6. [Como o sistema funciona](#como-o-sistema-funciona)
7. [Funções auxiliares](#funções-auxiliares)
8. [Dados](#dados)
9. [Segurança](#segurança)
10. [Melhorias futuras](#melhorias-futuras)

## Sobre o projeto

A Raia Sports vende tênis, bolas, bikes e acessórios. O visitante navega pelo catálogo, filtra por categoria, vê os detalhes de cada produto, monta um carrinho e finaliza a compra. Há também cadastro e login de clientes e uma página de pedidos.

Os dados ficam em arquivos (PHP e JSON), então a loja roda em qualquer computador com PHP, sem instalar banco de dados.

## Funcionalidades

- Catálogo com 12 produtos e filtro por categoria.
- Página de detalhes com descrição e parcelamento em até 6x sem juros.
- Carrinho: adicionar, aumentar, diminuir e remover itens, com subtotal e total.
- Cadastro, login e logout de usuários.
- Finalização de compra e consulta de pedidos.
- Página de diagnóstico para conferir o ambiente.

## Tecnologias

| Tecnologia | Uso |
|---|---|
| PHP 8.4| Back-end e páginas |
| HTML5 e CSS | Estrutura e visual (`assets/style.css`) |
| Sessões PHP | Carrinho e usuário logado |
| Servidor embutido do PHP | Execução local |


## Como executar


**Windows:** dê dois cliques em `iniciar.bat`.

**Qualquer sistema:** abra o terminal na pasta do projeto e rode:

```
php -S localhost:8000
```

Depois acesse <http://localhost:8000>.



## Estrutura de pastas

```
raia-sports/
├── index.php          Página inicial e catálogo
├── produto.php        Detalhes de um produto
├── carrinho.php       Carrinho de compras
├── diagnostico.php    Verificação do ambiente (temporário)
├── README.md          Esta documentação
├── includes/          Código compartilhado
│   ├── db.php         Acesso aos dados (sem PDO)
│   ├── functions.php  Funções auxiliares
│   ├── header.php     Cabeçalho das páginas
│   └── footer.php     Rodapé das páginas
├── login/             Autenticação
│   ├── login.php
│   ├── registrar.php
│   └── logout.php
├── app/               Área da compra
│   ├── checkout.php
│   └── pedidos.php
├── database/          Dados
│   ├── produtos.php   Catálogo de produtos
│   ├── usuarios.json  Criado no primeiro cadastro
│   └── pedidos.json   Criado na primeira compra
└── assets/
    └── style.css      Estilos
```

## Como o sistema funciona

### Página inicial (`index.php`)

Mostra um banner e a grade de produtos. As categorias são tiradas automaticamente dos produtos (sem repetição, em ordem alfabética) e viram filtros. Clicar em uma categoria recarrega a página com `?cat=Categoria`; o botão "Todos" remove o filtro.

### Detalhe do produto (`produto.php`)

Recebe o `id` pela URL (ex.: `produto.php?id=3`) e mostra nome, categoria, descrição, preço e o valor da parcela (preço ÷ 6). Se o produto não existir, responde com HTTP 404 e a mensagem "Produto não encontrado".

### Carrinho (`carrinho.php`)

O carrinho fica na sessão, no formato `$_SESSION['carrinho'][id] = quantidade`. A página recebe ações por POST:

| Ação | Efeito |
|---|---|
| `add` | Soma 1 e redireciona para o carrinho |
| `mais` | Soma 1 à quantidade |
| `menos` | Subtrai 1; se chegar a 0, remove o item |
| `remover` | Remove o item |

Depois de cada ação a página redireciona para si mesma (padrão *Post/Redirect/Get*), o que evita reenvio do formulário ao atualizar. O botão **Finalizar compra** leva a `app/checkout.php`.

### Login, cadastro, checkout e pedidos


> [Complete esta parte: campos do cadastro, como a senha é guardada e o que o checkout pede.]

### Fluxo de uso

1. O cliente escolhe uma categoria (opcional).
2. Abre um produto ou adiciona direto ao carrinho.
3. Ajusta as quantidades no carrinho.
4. Clica em **Finalizar compra** e faz login, se necessário.
5. O pedido é registrado e aparece na página de pedidos.

## Funções auxiliares

Definidas em `includes/`:

| Função | Uso |
|---|---|
| `produtos()` | Retorna a lista completa de produtos |
| `produto($id)` | Retorna um produto pelo id |
| `carrinho_itens()` | Monta os itens do carrinho com preço, quantidade e subtotal |
| `dinheiro($valor)` | Formata um valor como moeda |
| `e($texto)` | Escapa texto para HTML (evita XSS) |
| `csrf()` | Gera o token CSRF dos formulários |
| `csrf_ok()` | Confere se o token enviado é válido |

## Dados

- **Produtos:** edite `database/produtos.php`. Cada produto tem `id`, `nome`, `categoria`, `preco`, `descricao`, `icone` (emoji) e `cor` (fundo do cartão).


## Segurança

- **CSRF:** todo formulário POST envia o campo oculto `csrf`, e o carrinho só age se `csrf_ok()` validar o token.
- **XSS:** os textos exibidos passam por `e()`.
- **Validação:** o `id` do produto é convertido para inteiro com `(int)`.
- **Post/Redirect/Get:** evita ações duplicadas ao recarregar.
- **Atenção:** remova o `diagnostico.php` antes de publicar o site.

## Melhorias futuras

- Controle de estoque e pagamento real.
- Busca por nome e ordenação por preço.
- Imagens reais dos produtos no lugar de emojis.
- Painel administrativo para cadastrar produtos.
