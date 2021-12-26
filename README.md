
# Street Directory

Street Directory API.

## Setup

1. Build and run docker containers using docker-compose

```
make build up
```

2. Enter into docker container

```sh
# after enter the command, write 'php'
make goto
```

3. Install packages with composer

```
composer i
```

4. Install development tools. As recommended on their website, **php-cs-fixer** is installed in a dedicated `composer.json`.

```
cd tools/php-cs-fixer
composer i
```

5. Check the website

```
localhost:8080
```

## Git Hooks

Enable custom `pre-commit` hook to run [php-cs-fixer](https://cs.symfony.com) before each commit

1. Make the hook runnable

```
chmod +x hooks/pre-commit
```

2. Create a symbolic link to link our custom hook to the one in the `.git/hooks` folder

```
ln -s ../../hooks/pre-commit .git/hooks/pre-commit
```

## License

This project is licensed under [MIT license](./LICENSE).
