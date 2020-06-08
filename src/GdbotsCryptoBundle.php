<?php
declare(strict_types=1);

namespace Gdbots\Bundle\CryptoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

final class GdbotsCryptoBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
