# Aplicação de Gerenciamento de Usuários

## Descrição

Esta é uma aplicação simples desenvolvida utilizando Angular 16 e Laravel 10. O objetivo principal é permitir o gerenciamento de usuários em um sistema.    
Visualize a aplicação Angular no repositório abaixo  
https://github.com/EduardoMGP/MaithaApp

### Confira abaixo algumas informações importantes sobre o sistema.

## Rotas da API

- Autenticação:
  - `POST` https://maitha.api.uaibits.com.br/api/auth/login
  - `POST` https://maitha.api.uaibits.com.br/api/auth/register
  - `POST` https://maitha.api.uaibits.com.br/api/auth/logout
  - `POST` https://maitha.api.uaibits.com.br/api/auth/logout-all

- Usuários:
  - `GET` https://maitha.api.uaibits.com.br/api/users
  - `POST` https://maitha.api.uaibits.com.br/api/users
  - `GET` https://maitha.api.uaibits.com.br/api/users/{user}
  - `PUT` https://maitha.api.uaibits.com.br/api/users/{user}
  - `DELETE` https://maitha.api.uaibits.com.br/api/users/{user}

Visualize a documentação completa da API no link abaixo  
https://documenter.getpostman.com/view/8500239/2s93zGzyFt#4b37de47-297f-4ba9-bb7f-a679379bd0ad

## Metas do Sistema

### Back-End (API)

Algumas metas para melhorar o sistema no lado do servidor incluem:

- Aumentar a segurança implementando tokens mais elaborados e utilizando o "refresh_token" para renovar as sessões, proporcionando maior proteção.
- Adicionar níveis de permissões para restringir as operações apenas a usuários autorizados, garantindo a segurança e controle adequados.
- Introduzir novas funcionalidades, como permitir que os usuários gerenciem os dispositivos conectados às suas contas, aumentando a flexibilidade e controle do sistema.

### Aplicação Web

Algumas melhorias planejadas para a aplicação web incluem:

- Aprimorar o layout, tornando-o mais fluido e funcional para os usuários, proporcionando uma experiência agradável.
- Resolver problemas de responsividade em dispositivos móveis, garantindo que a aplicação seja utilizável em diferentes tamanhos de tela.
- Melhorar a usabilidade ao cadastrar um novo usuário pelo painel, evitando atualizações completas da página e atualizando apenas os dados relevantes na tabela, tornando o processo mais eficiente e intuitivo.
- Otimizar a folha de estilos do template, removendo estilos duplicados e melhorando o desempenho da aplicação.
- Componentizar a aplicação de forma mais eficiente, reutilizando código e evitando a repetição desnecessária de lógica, o que facilitará a manutenção e expansão futuras.

---
