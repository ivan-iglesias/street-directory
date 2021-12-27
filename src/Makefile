all:
	@-exit 1

load_test_environment:
	php bin/console --env=test doctrine:schema:drop --force --full-database
	php bin/console --env=test doctrine:migrations:migrate --no-interaction
	php bin/console --env=test doctrine:fixtures:load --no-interaction

test_app:
	@make -s load_test_environment
	bin/phpunit --testsuite application

test_int:
	@make -s load_test_environment
	bin/phpunit --testsuite integration

test_unit:
	bin/phpunit --testsuite unit
