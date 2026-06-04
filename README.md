
## 1. Clonar o repositório

```bash
git clone https://github.com/Mariaquiteria26/projeto-PW.git
```

## 2. Entrar na pasta do projeto

```bash
cd projeto-PW
```

## 3. Iniciar os containers

```bash
docker compose up -d --build
```

## 4. Abrir o phpMyAdmin

Acesse:

```text
http://localhost:8081
```

Usuário:

```text
root
```

Senha:

```text
root
```

## 5. Importar o banco de dados

Selecione o banco:

```text
cinema_control
```

Clique em:

```text
Importar
```

Selecione o arquivo:

```text
banco/cinema_control.sql
```

Clique em:

```text
Executar
```

## 6. Abrir o sistema

Acesse:

```text
http://localhost:8080/login/login.php
```

## Comandos úteis

Parar os containers:

```bash
docker compose down
```

Iniciar novamente:

```bash
docker compose up -d
```

Ver os containers em execução:

```bash
docker ps
```
