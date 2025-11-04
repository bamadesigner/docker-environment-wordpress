# Docker Environment for WordPress

## Local development

- [Setup your .env file](#setup-environment-env-file)
- [Setup local SSL certificate](#setup-local-ssl-certificate)
- [Start Docker containers](#start-docker-containers)
- [Stop Docker containers](#stop-docker-containers)
- [Backup/export your database](#backupexport-your-database)

### Setup environment `.env` file

Copy `.env.example` to `.env` to use for your containers. Modify `.env` variables as desired.

### Choose a local development domain

This stack uses `https://wordpress.local` as the root host and origin.

If you wish to use a different domain, make sure the following is set in your `.env` file:

```bash
DOMAIN=mycustomlocaldomain.com
```

### Setup local SSL certificate

You can use [mkcert](https://github.com/FiloSottile/mkcert) to create locally-trusted development certificates.

If desired, replace `wordpress.local` with [your preferred local development domain](#choose-a-local-development-domain) and run the following commands in your terminal.

```bash
mkcert -install
```
```bash
# If desired, replace "wordpress.local" with your preferred domain.
mkcert wordpress.local localhost 127.0.0.1 ::1
```

This process will create two certificates: `wordpress.local+4.pem` and `wordpress.local+4-key.pem` (or files with similar names and your custom domain).

Place both of these generated files in your local repository with the following file path, relative to the root repository directory:

```text
/.docker/certificates/wordpress.local-key.pem
/.docker/certificates/wordpress.local.pem
```

If you set a custom domain name, be sure that the file names contain your custom domain.

For example, if your custom domain is `mycustomlocaldomain.com`, your files would be:

```text
/.docker/certificates/mycustomlocaldomain.com-key.pem
/.docker/certificates/mycustomlocaldomain.com.pem
```

The repo's `.docker/certificates` directory is ignored from .git and mounted in the Docker dev container.

Add the following to your local hosts file:

```text
# Local WordPress development
127.0.0.1 wordpress.local
```

Or with your custom domain:

```text
# Local WordPress development
127.0.0.1 mycustomlocaldomain.com
```

## Start Docker containers

Run one of the following commands to start the Docker environment.

You can append any of the [available options for `docker compose up`](https://docs.docker.com/reference/cli/docker/compose/up/) to the end of the command.

### 1. Start the containers

```bash
bash scripts/docker/up.sh
```

### 2. Start the containers in "detached" mode

```bash
bash scripts/docker/up.sh -d
```

### 3. Force-recreate the containers and start

```bash
bash scripts/docker/up.sh --force-recreate
```

### 4. Force re-create containers and start in "detached" mode

```bash
bash scripts/docker/up.sh --force-recreate -d
```

## Stop Docker containers

You can append any of the [available options for `docker compose down`](https://docs.docker.com/reference/cli/docker/compose/down/) to the end of the command.

### 1. Stop the containers

```bash
bash scripts/docker/down.sh
```

### 2. Stop the containers and remove images

```bash
bash scripts/docker/down.sh --rmi
```

## Managing dependencies with Composer

This repo uses Composer to manage WordPress plugins and themes.

### Installing dependencies

`composer install` is run every time you start up the stack.

To run separately:

```bash
bash scripts/composer/install.sh
```

### Updating dependencies

```bash
bash scripts/composer/update.sh
```

### Adding dependencies

```bash
bash scripts/composer/require.sh [dependency] [version]
```

```bash
bash scripts/composer/require.sh johnbillion/query-monitor
```

## Backup/export your database

First, [run your containers in detached mode](#2-start-the-containers-in-detached-mode).

Then run the following command to create a backup.sql file of your database:

```bash
bash scripts/database/backup.sh
```