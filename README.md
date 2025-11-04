# Docker Environment for WordPress

## Local development

- [Setup your .env file](#setup-environment-env-file)
- [Setup local SSL certificate](#setup-local-ssl-certificate)
- [Start Docker](#start-docker)

### Setup environment .env file

Copy `.env.example` to `.env` to use for build.

### Setup local SSL certificate

Use [mkcert](https://github.com/FiloSottile/mkcert) to create locally-trusted development certificates.

Open Terminal and run the following commands:

Replace `wordpress.local` with your preferred local domain for development.

```bash
mkcert -install

mkcert wordpress.local localhost 127.0.0.1 ::1
```

This process will create two certificates: `wordpress.local+4.pem` and `wordpress.local+4-key.pem` (or files with similar names).

Place both of these files in your local repository with the following file path, relative to the root repository directory:

```
/.docker/certificates/wordpress.local-key.pem
/.docker/certificates/wordpress.local.pem
```

The repo's `.docker/certificates` directory is ignored from .git and mounted in the Docker dev container.

Add to hosts file

```
127.0.0.1 wordpress.local
```

## Start Docker

Run the following command in your terminal to start the environment.

It will force-recreate the container and run the containers in "detached" mode.

```bash
bash scripts/docker/up.sh
```

## Shut down Docker

```bash
bash scripts/docker/down.sh
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
