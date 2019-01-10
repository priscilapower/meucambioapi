## Meu Câmbio API

A API recupera as notícias do RSS [http://pox.globo.com/rss/g1/economia](http://pox.globo.com/rss/g1/economia) e disponibiliza os dados formatados e paginados de forma clara e organizada para serem renderizadas.


## Usando a API

Após fazer o clone da aplicação, execute o seguinte comando para instalar os pacotes de dependência:

`composer install`

Assim que a instalação for concluída, inicie a aplicação no servidor, como por exemplo:

`php artisan serve`

Acesse http://localhost:8000 para verificar se a aplicação está rodando.

## Rotas

A API disponibiliza duas rotas.

- `/news`
    
    Retorna um objeto json com as notícias paginadas, contendo 10 por página e os itens de paginação, como o total e as rotas das próximas páginas.
    

- `/news/:id`

    Retorna um objeto com todos os dados da notícia referenciado pelo id passado.


**IMPORTANTE: O RSS não informa o id das notícias, então a API gera um hash md5 do conteúdo da tag _guid_ e o utiliza como o identificador.**

## Exemplo

Conteúdo da tag guid:

`https://g1.globo.com/economia/tecnologia/noticia/2019/01/09/como-a-amazon-se-transformou-na-empresa-mais-valiosa-do-mundo.ghtml`

Hash md5 gerado a partir da tag guid:

`7219195eabbd9e8808214496bfb6a65a`

Aplicação na rota:

`/news/7219195eabbd9e8808214496bfb6a65a`


#### Obrigada pela utilização :)
