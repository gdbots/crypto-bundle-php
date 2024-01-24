<?php
declare(strict_types=1);

namespace Gdbots\Bundle\CryptoBundle\Twig;

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class CryptoExtension extends AbstractExtension
{
    public function __construct(private Key $key, private bool $debug = false)
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('encrypt', [$this, 'encrypt']),
            new TwigFunction('decrypt', [$this, 'decrypt']),
        ];
    }

    public function encrypt(string $string): ?string
    {
        if (empty($string)) {
            return null;
        }

        try {
            return Crypto::encrypt($string, $this->key);
        } catch (\Throwable $e) {
            if ($this->debug) {
                throw $e;
            }
        }

        return null;
    }

    public function decrypt(string $string): ?string
    {
        if (empty($string)) {
            return null;
        }

        try {
            return Crypto::decrypt($string, $this->key);
        } catch (\Throwable $e) {
            if ($this->debug) {
                throw $e;
            }
        }

        return null;
    }
}
