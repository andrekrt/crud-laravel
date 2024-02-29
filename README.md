## Requisitos

* PHP 8.2 ou superior
* Composer
* Node.js 20 ou superior
* GIT

## Como rodar o projeto baixado

Duplicar o arquivo ".env.example" e renomear para ".env".<br>
Alterar no arquivo .env o nome da base de dados para "celke". Exemplo: DB_DATABASE=celke.<br>
Para a funcionalidade recuperar senha funcionar, necessário alterar as credenciais do servidor de envio de e-mail no arquivo .env.<br>

Instalar as dependências do PHP
```
composer install
```

Instalar as dependências do Node.js
```
npm install
```

Gerar a chave
```
php artisan key:generate
```

Executar as migration
```
php artisan migrate
```

Executar as seed
```
php artisan db:seed
```

Iniciar o projeto criado com Laravel
```
php artisan serve
```

Executar as bibliotecas Node.js
```
npm run dev
```

Acessar o conteúdo padrão do Laravel
```
http://127.0.0.1:8000/
```

## Sequencia para criar o projeto
Criar o projeto com Laravel
```
composer create-project laravel/laravel laravel-meu-projeto
```

Acessar op diretório onde está o projeto
```
cd laravel-meu-projeto
```

Iniciar o projeto criado com Laravel
```
php artisan serve
```

Acessar o conteúdo padrão do Laravel
```
http://127.0.0.1:8000/
```

Criar a migration
```
php artisan make:migration create_name_table
```
```
php artisan make:migration create_courses_table
```

Executar as migration
```
php artisan migrate
```

Criar Controller
```
php artisan make:controller NomeDaController
```
```
php artisan make:controller CourseController
```

Criar a VIEW
```
php artisan make:view nomeDaView
```
```
php artisan make:view courses/create
```

Criar Models
```
php artisan make:model NomeDaModel
```
```
php artisan make:model Course
```

Rollback (reverter) a migração mais recente
```
php artisan migrate:rollback
```

Criar seed
```
php artisan make:seeder NomeDoSeeder
```
```
php artisan make:seeder CourseSeeder
```

Executar as seed
```
php artisan db:seed
```

Criar um arquivo de Request com validações
```
php artisan make:request NomeDoRequest
```

```
php artisan make:request CourseRequest
```

Instalar o pacote de auditoria do Laravel
```
composer require owen-it/laravel-auditing
```

Publicar a configuração e as migration para auditoria
```
php artisan vendor:publish --provider "OwenIt\Auditing\AuditingServiceProvider" --tag="config"
```
```
php artisan vendor:publish --provider "OwenIt\Auditing\AuditingServiceProvider" --tag="migrations"
```

Limpar cache de configuração
```
php artisan config:clear
```

Recarregar as classes do Composer
```
composer dump-autoload
```

Instalar o Vite
```
npm install
```

Instalar o framework Bootstrap
```
npm i --save bootstrap @popperjs/core
```

Executar as bibliotecas Node.js
```
npm run dev
```

Limpar cache de configuração
```
php artisan config:clear
```

Limpar cache de rotas
```
php artisan route:clear
```

Limpar cache de views
```
php artisan view:clear
```

Limpar cache de eventos e listeners
```
php artisan event:clear
```

Limpar cache de configuração
```
php artisan cache:clear
```

Configurar e-mail recuperar senha
```
php artisan vendor:publish --tag=laravel-mail
```

Instalar a dependência de permissão
```
composer require spatie/laravel-permission
```

Criar as migrations
```
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

Limpar o cache de configuração
```
php artisan config:clear
```

Executar as migrations
```
php artisan migrate
```

### Será criado 5 tabelas
* funções/roles – Esta tabela armazenará o nome de todas as funções da aplicação.
* permissões/permissions – Esta tabela armazenará o nome de todas as permissões do aplicativo.
* role_has_permissions  – Esta tabela armazenará todas as permissões atribuídas a cada função.
* model_has_roles  – Esta tabela armazenará funções atribuídas a cada modelo.
* model_has_permissions  – Esta tabela armazenará as permissões atribuídas a cada modelo. Por exemplo, um modelo de usuário.

Criar seed de permissão
```
php artisan make:seeder PermissionSeeder
```

Criar seed papel
```
php artisan make:seeder RoleSeeder
```


## Enviar para o GitHub
Iniciar novo packet com GIT na máquina 
```
git init
```

Definir as configurações do usuário
```
git config --local user.name Cesar
```
```
git config --local user.email cesar@meuemail.com.br
```

Baixar os arquivos do Git
```
git clone --branch <branch_name> <repository_url>
```
```
git clone --branch dev-master https://github.com/celkecursos/laravel-meu-projeto.git
```

Verificar a branch
```
git branch  
```

Baixar as atualizações
```
git pull
```
