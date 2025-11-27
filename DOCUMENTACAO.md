# 📄 Documentação  Projeto: EstoqueApp

**Desenvolvedor:** [Josè Felipe de Holanda Novelino]
**Disciplina:** SPOPWEB - Programação Dinâmica para Web (Tavares/2025s2)
**Status:** Concluído (CRUD, ACL, Search, XML, Otimização Visual)

---

## I. Introdução e Objetivo do Sistema

O **EstoqueApp** é um sistema de gestão de inventário focado em usabilidade e segurança. O projeto foi desenvolvido aplicando o padrão MVC e todas as fases do CRUD (Criação, Leitura, Atualização e Exclusão), com foco especial em requisitos de segurança e manipulação de dados em ambientes dinâmicos.

**Principais Metas do Projeto:**
1.  Implementar o CRUD completo para a entidade `Produto`.
2.  Garantir a segurança dos dados com Controle de Acesso (ACL).
3.  Implementar a persistência com Chave Primária Universal (UUID).
4.  Fornecer exportação de dados em formatos padronizados (XML).

---

## II. Arquitetura e Tecnologias

O projeto utiliza a seguinte pilha tecnológica (stack):

| Componente | Tecnologia | Observações |
| :--- | :--- | :--- |
| **Backend Framework** | Laravel 11 | Lógica de aplicação, ORM Eloquent, e Middlewares. |
| **Banco de Dados** | SQLite | Persistência local (`database/database.sqlite`) para o ambiente de desenvolvimento. |
| **Frontend Styling** | Tailwind CSS / Breeze | Design responsivo, tema unificado "Azul e Preto" e componentes modernos. |
| **Chave Primária** | UUID | Utilização do `HasUuids` no Model `Produto` para identificadores únicos universais. |
| **Dados Dinâmicos** | Chart.js | Geração de gráficos para visualização de tendências no Dashboard. |

---

## III. Segurança e Controle de Acesso (ACL)

A segurança é o ponto mais forte da aplicação, implementada com as seguintes regras:

### A. Autorização (Gates - Regra de Posse)

* **Regra:** Definida no `AppServiceProvider.php` (método `boot()`) via `Gate::define('update-produto', ...)`.
* **Lógica:** Apenas o usuário que criou um produto (`$user->id`) tem permissão para editar, atualizar ou excluir aquele produto (`$produto->user_id`).
* **Proteção:** Os métodos `edit`, `update` e `destroy` são protegidos contra acesso não autorizado (retornam **403 Forbidden**).

### B. Proteção de Dados

* **Vínculo Obrigatório:** O Controller (`store`) salva o `auth()->id()` no Model, garantindo que todo produto tenha um dono.
* **Mass Assignment Fix:** A propriedade `protected $guarded = [];` foi utilizada no Model `Produto` para evitar que o campo `user_id` fosse bloqueado pelo sistema de segurança do Laravel.
* **Unicidade:** Validação que impede que um único usuário crie produtos com nomes duplicados (usando `Rule::unique` com escopo no `user_id`).

---

## IV. Funcionalidades Implementadas

### A. Gestão de Produtos (CRUD Otimizado)

| Funcionalidade | Controller/Método | Detalhes da Implementação |
| :--- | :--- | :--- |
| **Criação (CREATE)** | `store()` | Validação rigorosa e sanitização (`Str::title`) do nome e descrição. |
| **Edição (UPDATE)** | `update()` | **Lógica de SOMA de Estoque:** O campo no formulário (`adicionar_estoque`) apenas soma (ou subtrai) o valor ao estoque atual, evitando erros de sobrescrita. |
| **Listagem (READ)** | `index()` | **Barra de Pesquisa (Search):** Filtra a lista por `nome` ou `descricao` (`WHERE LIKE`). |
| **Aparência** | Views Blade | Tema unificado Azul/Preto com botões e ícones consistentes (escalabilidade resolvida). |

### B. Exportação de Dados

* **Rota:** `GET /produtos/xml` (rota com ordem priorizada para evitar conflito).
* **Controller:** `ProdutoXmlController` carrega os dados com `Produto::with('user')` (otimização N+1).
* **Output:** Gera um documento XML formatado com padrões rigorosos (ISO 8601), incluindo dados de preço, quantidade e informações do usuário criador (riqueza de dados).

---

## V. Próximos Passos Sugeridos

O projeto pode ser expandido adicionando as seguintes funcionalidades de alta prioridade:

1.  **Imagens:** Adicionar a capacidade de upload de imagens para o produto (uso de `storage` e *file handling*).
2.  **Categorias:** Implementar a modelagem de `Categorias` para organizar os produtos por tipo (requer nova migration e Model, e relações `belongsTo`).
3.  **Alertas:** Adicionar um sistema de alertas visuais para produtos com estoque abaixo de um limite pré-definido.
