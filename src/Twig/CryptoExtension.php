<?php
declare(strict_types=1);

namespace Gdbots\Bundle\CryptoBundle\Twig;

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class CryptoExtension extends AbstractExtension
{
    private Key $key;
    private bool $debug = false;

    public function __construct(Key $key, bool $debug = false)
    {
        $this->key = $key;
        $this->debug = $debug;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('encrypt', [$this, 'encrypt']),
            new TwigFunction('decrypt', [$this, 'decrypt']),
        ];
    }

    /**
     * Returns an encrypted string or null if it fails.
     *
     * @param string $string
     *
     * @return string
     *
     * @throws \Throwable
     */
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

    /**
     * Returns the decrypted data or null if it fails.
     *
     * @param string $string
     *
     * @return string
     *
     * @throws \Throwable
     */
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
