<?php
declare(strict_types=1);

namespace Gdbots\Bundle\CryptoBundle\DependencyInjection;

use Defuse\Crypto\Key;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

final class GdbotsCryptoExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../../config'));
        $loader->load('services.xml');
        $container->setAlias(Key::class, 'crypto_key');
    }
}
