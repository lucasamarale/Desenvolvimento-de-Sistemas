# To-Do List - Sistema de Tarefas

Projeto desenvolvido em PHP com PDO e MySQL, utilizando Bootstrap 5 como framework CSS.

## Tecnologias utilizadas

- PHP (PDO)
- MySQL
- Bootstrap 5 (via CDN)
- XAMPP

## Como rodar o projeto

### Requisitos
- XAMPP instalado (Apache + MySQL)

### Passo a passo

1. Clone ou baixe este repositorio e copie os arquivos para:
   ```
      C:\xampp\htdocs\tarefas\
         ```

         2. Inicie o **Apache** e o **MySQL** no painel do XAMPP.

         3. Acesse o **phpMyAdmin**: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)

         4. Clique em **SQL** e execute o conteudo do arquivo `script.sql` para criar o banco de dados e as tabelas.

         5. Acesse o sistema no navegador:
            ```
               http://localhost/tarefas/login.php
                  ```

                  ### Login padrao

                  | Campo   | Valor    |
                  |---------|----------|
                  | Usuario | admin    |
                  | Senha   | 123456   |

                  ## Funcionalidades

                  - Login e logout com sessao
                  - Listagem de tarefas por usuario
                  - Criar nova tarefa
                  - Editar tarefa
                  - Marcar tarefa como concluida
                  - Excluir tarefa
