test-all:
	./vendor/bin/phpunit
test-one:
	./vendor/bin/phpunit --filter=$(arg)
