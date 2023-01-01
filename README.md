Crewbit Laravel Boilerplate
===========================

## Requirements

- Docker
- Docker Compose
- [Crewbit nginx-proxy](https://github.com/crew-bit/nginx-proxy.git)

## Setup

1. GitHub でリポジトリを作成する時、「Repository template」を `crew-bit/laravel-boilerplate` にしてリポジトリ作成
1. `docker-compose.yml` ファイルを開き、下記箇所をプロジェクトに合わせて修正
    - mysql コンテナの `MYSQL_DATABASE: project_dev` を `{プロジェクト名}_dev` に変更
    - db-admin コンテナの `VIRTUAL_HOST: pmd.project.test` を `pmd.{プロジェクト名}.test` に変更
    - web コンテナの `VIRTUAL_HOST: project.test` を `{プロジェクト名}.test` に変更
1. `composer.json` ファイルを開き、下記箇所をプロジェクトに合わせて修正
    - `name: crew-bit/laravel-boilerplate` を作成したリポジトリ名に変更
    - `description: Crewbit Laravel Boilerplate` をプロジェクトの概要に変更
1. `.env.example` ファイルを開き、下記箇所をプロジェクトに合わせて修正
    - `APP_NAME=ProjectName` を作成したプロジェクトの名前に変更
    - `APP_URL=http://localhost` を `http://{プロジェクト名}.test` に変更
    - `DB_DATABASE=project_dev` を `{プロジェクト名}_dev` に変更

## Installation

```bash
$ docker-compose build
$ docker-compose run php-cli composer install
$ docker run --rm -it -v $(pwd):/app -w /app node:16 npm install

$ cp .env.example .env
$ vim .env

$ docker-compose run php-cli php artisan key:generate
$ docker-compose run php-cli php artisan migrate --seed
```

## Development

```bash
$ docker-compose up -d

## 必要に応じて
$ docker run --rm -it -v $(pwd):/app -w /app node:16 npm run watch
```

## Deploy

デプロイには Deployer を使用しています。
https://crewbit.esa.io/posts/1415 に従い作業をしてください。
