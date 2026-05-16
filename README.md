# Laravel-Simple-Version
### Manage easily your Laravel app version

> Requires PHP 8.1+ and Laravel 10, 11 or 12.
> For Laravel 6, 7 or 8, use version [1.2](https://github.com/J2Nlab/laravel-simple-version/tree/v1.2).

## Description

With this package, you can:
- print a version on a page;
- print it in the console, via an artisan command;
- increments version number, via an artisan command.

## Installation

Via Composer

``` bash
$ composer require j2nlab/laravel-simple-version
```

Then publish the configuration file:

``` bash
$ php artisan vendor:publish --provider="J2Nlab\SimpleVersion\ServiceProvider"
```

The initial `config/version.php` is:

``` php
<?php

return array (
  'major' => 0,
  'minor' => 0,
  'patch' => 0,
  'build' => false,
  'commit' => false,
);
```

If build is `false`, then this number is ignored; else it's incremented and never reset to 0.
If you want a build number, set to any value (0 or 1, for example).

If commit is `false`, this number is ignored; else get the first 6 digits of the last local commit.
If you want a commit number, set it to any value (0 or 1, for example).

## Artisan commands

All available commands are:

``` bash
$ php artisan version         
$ php artisan version:major   
$ php artisan version:minor   
$ php artisan version:patch   
$ php artisan version:build   
$ php artisan version:commit  
```

### php artisan version

Display version number, in different ways available with helpers and Blade directive, currently 'full' and 'compact' (the default).

``` bash
$ php artisan version
Version (compact): 1.1.1-11-f44744
Version (full): version 1.1.1 (build: 11) (commit: f44744)
```

Or, if build value is `false`.

``` bash
$ php artisan version
Version (compact): 1.1.1-f44744
Version (full): version 1.1.1 (commit: f44744)
```

Or, if build and commit values are `false`.

``` bash
$ php artisan version
Version (compact): 1.1.1
Version (full): version 1.1.1
```

Or, if patch and build values are `false`.

``` bash
$ php artisan version
Version (compact): 1.1-f44744
Version (full): version 1.1 (commit: f44744)
```

### php artisan version:commit

If the commit value on `config/version.php` is not `false`, get the first 6 digits of the last git local commit.

``` bash
$ php artisan version:commit
New commit number: db5a4a
New version: 1.1.1-9-db5a4a
```

Or, if commit value is `false`.

``` bash
$ php artisan version:commit
No commit number!
```

### php artisan version:build

If the build value on `config/version.php` is not `false`, increment build number.
This number is never reset to 0.

``` bash
$ php artisan version:build
New build number: 12
New version: 1.1.1-12-db5a4a
```

Or, if build value is `false`.

``` bash
$ php artisan version:build
No build number!
```

### php artisan version:patch

If the patch value on `config/version.php` is not `false`, increment app patch number.

``` bash
$ php artisan version:patch
New patch version: 2
New version: 1.1.2-12-db5a4a
```

Or, if patch value is `false`.

``` bash
$ php artisan version:patch
No patch number!
```

### php artisan version:minor

Increment app minor number version. The patch number is reset to 0, unless it has been disabled (`false`), in which case it stays disabled.

``` bash
$ php artisan version:minor
New minor version: 2
New version: 1.2.0-12-db5a4a
```

### php artisan version:major

Increment app major number version. The minor number is reset to 0, and the patch number is reset to 0 unless it has been disabled (`false`).

``` bash
$ php artisan version:major
New major version: 2
New version: 2.0.0-12-db5a4a
```

### Summary...

It's really simple:

 - `'major' => 0,`      is incremented by `version:major`
 - `'minor' => 0,`      is incremented by `version:minor`, reset to 0 by `version:major`
 - `'patch' => 0,`      is incremented by `version:patch`, reset to 0 by `version:major`/`minor`
 - `'patch' => false,`  is never incremented, and stays `false` on `version:major`/`minor`
 - `'build' => 0,`      is incremented by `version:build`
 - `'build' => false,`  is never incremented
 - `'commit' => 0,`     is set with first 6 digits of last git commit by `version:commit`
 - `'commit' => false,` is never fetched

## Helper

You can use this helper to get a compact version format:

``` php
$version = version();
```

Or you can choose the format:

``` php
$version = version('compact');
$version = version('full');
```

Any unknown format falls back to `compact`.

## Blade directive

You can use this directive to render a compact version format:

``` php
@version
```

Or you can choose the format:

``` php
@version('compact')
@version('full')
```

## Testing

You can run some PHPunit tests with the following command:

``` bash
$ composer test
```

## License

This package is licensed under the MIT License - see the [LICENSE](LICENSE.md) file for details.
