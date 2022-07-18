# Hexagonal architecture

Building **Hexablog app**

The hexagonal architecture, or ports and adapters architecture, is an architectural pattern used in software design. It aims at creating loosely coupled application components that can be easily connected to their software environment by means of ports and adapters. 

In this project, we will create a simple blog as the architecture use case.

## Resources and Installation

Php version:

I used php:`8.1.*`, and enable the php-xml for running a pest and phpunit watcher, if
you have a `dom.so` extension in your php.ini is not require install the php-xml for runnig the
tests of app.

Install dev requirements for generate the vendor app 

```bash
composer install
```

for running the tests using makefile command

```bash
make test
```

<!-- After, generate the configurations of tests using pest

```bash
vendor/bin/pest --generate-config
```
Press enter, in the options.

After, will generate the phpunit xml and done -->

## Dependencies

- `pestphp/pest:` testing Framework with a focus on simplicity. It was carefully crafted to bring the joy of testing to PHP.
- `spatie/phpunit-watcher:` PHPUnit tests would be automatically rerun whenever you change some code? This package can do exactly that.
- `symfony/var-dumper:` the VarDumper component provides mechanisms for extracting the state out of any PHP variables. Built on top, it provides a better dump() function that you can use 