<?php

namespace Gdbots\Bundle\CryptoBundle\Twig;

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Exception\CryptoException;
use Defuse\Crypto\Key;

class CryptoExtension extends \Twig_Extension
{
    /** @var Key */
    protected $key;

    /** @var bool */
    protected $debug = false;

    /**
     * @param Key $key
     * @param bool $debug
     */
    public function __construct(Key $key, $debug = false)
    {
        $this->key = $key;
        $this->debug = (bool) $debug;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('encrypt', [$this, 'encrypt']),
            new \Twig_SimpleFilter('decrypt', [$this, 'decrypt'])
        ];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gdbots_crypto_extension';
    }

    /**
     * Returns an encrypted string or null if it fails.
     *
     * @param string $string
     *
     * @return string
     *
     * @throws \Exception
     * @throws CryptoException
     */
    public function encrypt($string)
    {
        if (empty($string)) {
            return null;
        }

        try {
            return Crypto::encrypt($string, $this->key);
        } catch (\Exception $e) {
            if ($this->debug) {
                throw $e;
            }
        }
    }

    /**
     * Returns the decrypted data or null if it fails.
     *
     * @param string $string
     *
     * @return string
     *
     * @throws \Exception
     * @throws CryptoException
     */
    public function decrypt($string)
    {
        if (empty($string)) {
            return null;
        }

        try {
            return Crypto::decrypt($string, $this->key);
        } catch (\Exception $e) {
            if ($this->debug) {
                throw $e;
            }
        }
    }
}
