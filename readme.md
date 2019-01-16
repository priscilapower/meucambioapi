## Meu Câmbio API

A API recupera as notícias do RSS [http://pox.globo.com/rss/g1/economia](http://pox.globo.com/rss/g1/economia) e disponibiliza os dados formatados e paginados de forma clara e organizada para serem renderizadas.


## Usando a API

Após fazer o clone da aplicação, execute o seguinte comando para instalar os pacotes de dependência:

`composer install`

Para criarmos o banco de dados no MySQL, execute o comando abaixo escolhendo o nome do banco como preferir:

`echo create database nome_do_banco | mysql -u root -p`

Vá até o seu arquivo .env.example, que fica localizado na raíz do projeto, e crie uma cópia apenas como .env e altere os valores de banco de dados de acordo com a sua configuração de conexão.


DB_DATABASE=nome_do_banco

DB_USERNAME=usuario_do_banco

DB_PASSWORD=senha_do_banco

Execute no terminal o comando do laravel que registra uma chave validando a sua aplicação:

`php artisan key:generate`


Assim que a instalação for concluída e o banco for criado, inicie a aplicação no servidor, como por exemplo:

`php artisan serve`

Acesse http://localhost:8000 para verificar se a aplicação está rodando.

## Rotas

A API disponibiliza três rotas.

- `/load`

    Esta é a primeira rota a ser executada, pois irá carregar as notícias disponíveis no RSS em seu banco de dados. Não importa quantas vezes for executada, irá inserir apenas as notícias que ainda não estão na sua base.

- `/news`
    
    Retorna um objeto json com as notícias paginadas, contendo 10 por página e os itens de paginação, como o total e as rotas das próximas páginas.
    

- `/news/:id`

    Retorna um objeto json com todos os dados da notícia referenciado pelo id passado.



## Exemplo

Carregando as notícias:

`https://localhost:8000/load`

Recuperando todos os registros:

`https://localhost:8000/news`

Recuperando um registro específico:

`https://localhost:8000/news/1`


#### Obrigada pela utilização :)
