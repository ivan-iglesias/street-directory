
# Street Directory

Street Directory API.

## Usage

1. Build and run docker containers using docker-compose

```
docker-compose up -d --build
```

2. Enter into docker container

```
docker exec -it streetdirectory_php bash
```

3. Install packages with composer

```
composer i
cd tools/php-cs-fixer
composer i
```

4. Check the website

```
localhost:8080
```

**Git Hooks**

Enable custom `pre-commit` hook to run [php-cs-fixer](https://cs.symfony.com) before each commit

1. Make the hook runnable

```
chmod +x hooks/pre-commit
```

2. Create a symbolic link to link our custom hook to the one in the `.git/hooks` folder

```
ln -s ../../hooks/pre-commit .git/hooks/pre-commit
```

> **_NOTE:_** php-cs-fixer has symfony 5 as a requirement, to avoid problems with the project composer file, we install it in a dedicated `composer.json` as recommended on their website.

## License

This project is licensed under [MIT license](./LICENSE).
