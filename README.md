# 🍔 AlphaLanches

**Descrição:**
Um sistema web para a lanchonete da escola Sete de Setembro em Paulo Afonso - BA, desenvolvido por estudantes do 3º período do curso de Sistema de Informações em parceria com a faculdade do mesmo grupo, UniRios também de Paulo Afonso - BA. Projeto realizado para melhorar a eficiência e promover a total eficácia das vendas de produtos alimentícios para os demais alunos.

---

## 📜 Índice

* [🚀 Sobre o Projeto](#-sobre-o-projeto)
* [🛠 Funcionalidades](#-funcionalidades)
* [📅 Futuras Funcionalidades](#-futuras-funcionalidades)
* [💻 Tecnologias Utilizadas](#-tecnologias-utilizadas)
* [📦 Requisitos](#-requisitos)
* [🔧 Instalação](#-instalação)
* [⚙️ Configuração](#️-configuração)
* [▶️ Executando o Projeto](#️-executando-o-projeto)
* [🗄️ Banco de Dados](#️-banco-de-dados)

---

## 🚀 Sobre o Projeto

Sistema web desenvolvido com Laravel para gerenciar uma lanchonete, incluindo funcionalidades como controle de estoque, vendas, reservas, cadastro de clientes e estatísticas financeiras e muito mais.

---

## 🛠 Funcionalidades

* 🛍️ Cadastro e gerenciamento de produtos (comidas, bebidas, etc.)
* 👤 Cadastro e Visualização de alunos/funcionários/responsáveis
* 🖌️ Perfil customizado com alterações em seus dados
* 🛒 Sistema de vendas (PDV)
* 💳 Múltiplas formas de pagamento (dinheiro, crédito, débito, PIX, etc.)
* 🏧 Sistema de recarga de créditos
* 📦 Controle de estoque com baixa
* 📈 Relatórios de vendas diárias, semanais e mensais
* 📊 Ranking de produtos mais vendidos
* 🔎 Filtro e busca de produtos e usuários
* 🔐 Autenticação e controle de acesso
* ✅ Histórico de vendas e pedidos
* 🕰️ Agendamento de um pedido

---

## 📅 Futuras Funcionalidades

* 🔑 Recuperação de senha através do email

---

## 💻 Tecnologias Utilizadas

* [Laravel](https://laravel.com/) (Framework PHP)
* [Bootstrap](https://getbootstrap.com/) (Front-end)
* [MySQL](https://www.mysql.com/) (Banco de dados)
* [Composer](https://getcomposer.org/) (Gerenciador de dependências PHP)
* [PHP](https://www.php.net/) >= 8.x

---

## 📦 Requisitos

* PHP >= 8.x
* Composer
* MySQL

---

## 🔧 Instalação

1. **Clone o repositório:**

   ```bash
   git clone https://github.com/Elliton-Luis/alphaLanches.git
   cd lanchonete
   ```

2. **Instale as dependências do PHP:**

   ```bash
   composer install
   ```
---

## ⚙️ Configuração

1. **Crie o arquivo de ambiente:**

   ```bash
   cp .env.example .env
   ```

2. **Configure o arquivo `.env` com os dados do banco de dados:**

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nome_do_banco
   DB_USERNAME=usuario
   DB_PASSWORD=senha
   ```

3. **Gere a chave da aplicação:**

   ```bash
   php artisan key:generate
   ```

---

## ▶️ Executando o Projeto

1. **Rode as migrações e (opcionalmente) os seeders:**

   ```bash
   php artisan migrate --seed
   ```
🚨 **OBS:** Verifique os seeds para saber a senha e o email para fazer login.

2. **Inicie o servidor de desenvolvimento:**

   ```bash
   php artisan serve
   ```

3. Acesse no navegador:
   [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🗄️ Banco de Dados

O projeto utiliza MySQL. As tabelas são criadas automaticamente via migrações. Caso deseje dados de exemplo, utilize o comando com `--seed` para popular o banco.

---
