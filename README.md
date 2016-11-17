crypto-bundle-php
=============

[![Build Status](https://api.travis-ci.org/gdbots/crypto-bundle-php.svg)](https://travis-ci.org/gdbots/crypto-bundle-php)
[![Code Climate](https://codeclimate.com/github/gdbots/crypto-bundle-php/badges/gpa.svg)](https://codeclimate.com/github/gdbots/crypto-bundle-php)
[![Test Coverage](https://codeclimate.com/github/gdbots/crypto-bundle-php/badges/coverage.svg)](https://codeclimate.com/github/gdbots/crypto-bundle-php/coverage)

Symfony3 bundle that integrates [defuse/php-encryption](https://github.com/defuse/php-encryption) package.


## Installation
When first using this bundle you'll need to generate a crypto key and store it as 
the kernel parameter `crypto_key`. 

#### 1. Run the following command from the root of your project.
```bash
vendor/bin/crypto-create-key
```

#### 2. Save the generated key to `parameters.yml`
```yaml
parameters:
  crypto_key: 'your generated crypto key'
```
> __WARNING__: keep this key private and secure. 

#### 3. Add `GdbotsCryptoBundle` to your `Kernel`
```php
<?php

use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        $bundles = [
            new Gdbots\Bundle\CryptoBundle\GdbotsCryptoBundle(),
            // more bundles...
        ];

        return $bundles;
    }
}
```
