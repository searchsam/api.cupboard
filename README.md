![](https://github.com/nerdify/cupboard-back-end/workflows/CI/badge.svg)

# CupBoard BackEnd

Simple api for simple database cupboard storage.

## Requirements

- PHP 7.2 or higher.
- Composer 1.9.0 or higher.
- MariaDB 10.0 or higher.
- MySQL 5.5 or higher.
- Redis Server 5.0 or higher.
- Supervisor 4.0 or higher.

> More detailed information on [Laravel Installation](https://laravel.com/docs/6.x/installation#server-requirements) page.

## GetUp

### 1\. Clone repo

```bash
git clone https://github.com/nerdify/cupboard-back-end.git
```

and go into repo `cupboard-back-end` dir.

### 2\. Set Environment

Copy the `.env.example` file into `.env` file and fill it with the data relevant to the technology you use.

```bash
cp .env.example .env
```

### 3\. Install Dependencies

```bash
composer install
npm install
```

### 4\. Run Migrations

Before running the `migrations`, make sure that the data for the connection to `MariaDB` (and/or `MySQL`) on your `.env` file is correct.

```cfg
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

Once you have ensured that your data is correct run the `migrations`.

```bash
php artisan migrate
```

### 5\. Populate Database

As with the `migrations` before running the `seeders` make sure that you have correct your connection data with the database.

```bash
php artisan db:seed
```

These migrations provide a default administrator user for user management purposes.

### 6\. Run Passport Migrations

As with the `migrations` and `seeders` before running the `passport installation` make sure that you have correct your connection data with the database.

```bash
php artisan passport:install
```

This command returns a message with its users for authentication by OAuth 2.0

```bash
Encryption keys generated successfully.
Personal access client created successfully.
Client ID: 1
Client secret: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
Password grant client created successfully.
Client ID: 2
Client secret: secrectkeyforuser2
```

Place user No 2 in your `.env` file

```cfg
PASSPORT_CLIENT_ID=2
PASSPORT_CLIENT_SECRET=secrectkeyforuser2
```

> Make sure you don't neglect where you put this data.

### 7.Connect to Redis

In order to use `queues` it is necessary to establish a connection with a `Redis` database. Make sure that the data for the connection to `Redis` on your `.env` file is correct.

```cfg
REDIS_URL=
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
REDIS_DB=
```

### 8\. Start Queue Broadcast

- By Artisan

```bash
php artisan queue:work redis
```

Alternatively, you may run the `queue:listen` command. When using the `queue:listen` command, you don't have to manually restart the worker after your code is changed; however, this command is not as efficient as `queue:work`.

```bash
php artisan queue:listen
```

> More detailed information on [Running The Queue Worker](https://laravel.com/docs/master/queues#running-the-queue-worker) page.

- By Supervisor

Before running `supervisor` make sure that `supervisord` is running and the `laravel worker program` in present on program section in `supervisor config file`.

```bash
sudo systemctl start supervisord.service
sudo vim /etc/supervisor.conf
```

```cfg
...

[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/laravel/app/artisan queue:work connection --sleep=3 --tries=3
autostart=true
autorestart=true
user=user-name
numprocs=8
redirect_stderr=true
stdout_logfile=/path/to/laravel/app/storage/logs/worker.log

...
```

Be sure to change the path to your laravel application on `command` and `stdout_logfile`, the connection on `queue:work connection` for `queue` you want and the user to exec to command on `user=user-name` space.

```bash
sudo supervisorctl reread
sudo supervisorctl update
```

The previous commands only run the first time. The next command starts the supervisor job program.

```bash
sudo supervisorctl start laravel-worker:*
```

Optionally you can add the following to the `supervisor` configuration file to manage your processes from the web interface.

```cfg
[inet_http_server]
port=0.0.0.0:9001
username=username
password=password
```

Be sure to provide a `username` and `password` to access the `supervisor web interface` in `username=username` and `password=password`. These data is not necessarily to be the `username` and/or `password` of your laravel application or server.

Once the configuration is established, restart the `supervisord` and access to `http://localhost:9001`.

```bash
sudo systemctl restart supervisord
```

> More detailed information on [Supervisor Configuration](https://laravel.com/docs/master/queues#supervisor-configuration) page.

## Start Development Server

```bash
php artisan server
```
