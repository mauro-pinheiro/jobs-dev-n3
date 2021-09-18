# StarGrid – Teste Desevolvedor(a) Backend N3

Para executar esse sistema é sugerido o uso do docker para facilitar a criação e configuração do ambiente de desenvolvimento.
## Instruções

1. Faça um clone deste repositório
2. Faça uma cópia do arquivo .env.exemple
     - Se estiver no linux, pode usar o comando: `cp .env.exemple .env`
     - Se estiver no window, pode usar o comando: `copy .env.exemple .env`
3. Lavante os containers da aplicação usando o comando: `docker-compose up -d`
      - A aplicação consiste de 3 contaiers:
        1. Container do webserver: *nginx*
        2. Container do banco de dados: *mariadb*
        3. Container da applicação
4. Entre no terminal dentro do conteiner *app*: `docker-compose exec app bash`
      - Dentro do container pode-se usar os comando normais de laravel
      - `composer install`
      - `php artisan migrate`
      - `php artisan key:generate`
5. Agora a aplicação esta disponivel em: http://localhost