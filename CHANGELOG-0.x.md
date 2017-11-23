# CHANGELOG for 0.x
This changelog references the relevant changes done in 0.x versions.


## v0.2.0
__BREAKING CHANGES__

* Require `"php": ">=7.1",`, mark all classes final, add `declare(strict_types=1);`, 
  and use php7 return type hints and scalar type hints.
* Add support for Symfony 4.


## v0.1.2
* issue #3: Fix the bin script's autoloader reference.


## v0.1.1
* issue #1: Add bin script to generate new key.  Run `vendor/bin/crypto-create-key` and optionally save that value to parameters.yml as `crypto_key`.


## v0.1.0
* Initial version.
