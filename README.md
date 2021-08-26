# Desafio FullStack-Economapas

## Sobre o PHP
- PHP 8.0.3(Versão usada nesse projeto)
- https://github.com/php/php-src

## SGBD
- MySql Server
- https://github.com/mysql/mysql-server

## Sobre o Jquery
- JqueryLib
- https://github.com/jquery/jquery

## Diagrama de classe

![diagrama de classes economapas](https://user-images.githubusercontent.com/27653290/131046521-036ae96d-aae1-4099-badb-4e2cbbe3ffae.png)

## Instruções de execução
- Instale e configura o PHP com instruções do link acima;
- Instale e configure o MySql com instruções do link acima;
- Clone este repositório em sua máquina;
- Navegue até o diretório ../../BD e importe o arquivo SQL economapas.sql em seu MySql Server;
- Altere o arquivo Conexao.php com as credencias de seu banco de dados;
- Navegue até o diretório onde se encontra o arquivo index.php e execute o comando php -S localhost:"porta desejata" exemplo: php -S localhost:8080 ;
- Em seu navegador insira a URL digitada no comando acima.

### Sobre o desafio

  Sistema desenvolvido em MVC, utilizando Ajax da bibliotéca Jquery para fazer requisições assíncronas em um arquivos de rotas, estes responsável por instanciar os modelos do banco de dados, retornando as respostas e convertendo para Json, utilizado para trabalhar  no dinamismo das páginas.
  Estilo da página em Boostrap v5.0.
