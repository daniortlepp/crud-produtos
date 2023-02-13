# crud-produtos
CRUD de produtos e autenticação em PHP com Laravel\
\
Siga as instruções abaixo para acessar a API.\
\
Primeiramente, você deve ter o composer previamente instalado. Para acessar pelo Docker, necessário Docker instalado também.\
\
Clone esse repositório em seu computador:
```sh
git clone https://github.com/daniortlepp/crud-produtos.git
```

Acesse o diretório da API
```sh
cd crud-produtos
```

Instale as dependências
```sh
composer update
```

Crie um arquivo .env com a seguinte configuração (lembrando de alterar o DB_USERNAME e DB_PASSWORD conforme usuário e senha do seu MySQL):
```sh
APP_NAME="CRUD Produtos"
APP_ENV=local
APP_KEY=base64:SY4C5hF/x2uNR04ob3cfJQvcCrbFyUgjCOwdK8WITqs=
APP_DEBUG=true
APP_URL=http://localhost:8180Cancel changes

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=crud_produtos
DB_USERNAME=username
DB_PASSWORD=password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

Crie um banco de dados no MySQL com o nome de crud_produtos. Para criar as tabelas necesárias, execute o comando:
```sh
php artisan migrate
```

Pode acessar pelo comando:
```sh
php artisan serve
```
E agora a API está pronta para você poder acessar através da URL http://localhost:8000\
\
Se desejar acessar pelo Docker, siga mais esses passos:\
\
Altere as seguintes configurações do arquivo .env:
```sh
DB_HOST=mysql

REDIS_HOST=redis
```

Acesse o diretório do Docker
```sh
cd laradock
```

Inicie o Docker para poder acessar a API
```sh
docker-compose up -d nginx mysql
```

E agora a API está pronta para você poder acessar através da URL http://localhost:8989

## Como funciona

Para conseguir utlizar a API, você deve primeiro se cadastrar. Será gerado um token que deve ser passado e todas as requisições que fizer a seguir.\
\
A API crud-produtos possui os seguintes endpoints:\
\
Autenticação:\
\
/register - POST\
Cadastro de um novo usuário\
Campos:\
name - obrigatório;\
email - obrigatório;\
password - obrigatório.

/login - POST\
Logar na API\
Campos:\
name - obrigatório;\
emaiil - obrigatório.\
\
/refresh - POST\
Gerar um novo token quando o mesmo expirar\
\
/logout - POST\
Fazer logout na API\
\
Produtos:\
\
/product - POST\
Cadastro de um novo produto\
Campos:\
name - obrigatório;\
description - obrigatório;\
value - obrigatório;\
active - obrigatório.\
\
/product - GET\
Listar todos os produtos cadastrados\
\
/product?search=palavra - GET\
Listar os produtos cadastrados conforme a palavra enviada na busca\
\
/product/{id} - GET\
Consulta os dados de um produto pelo id\
\
/product/{id} - PUT\
Edição de um produto\
\
/product/{id} - DELETE\
Exclusão de um produto

## Parâmetros do header

Authorization - recebe o valor do token gerado\
Accept - application/json
