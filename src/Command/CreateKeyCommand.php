<?php
declare(strict_types=1);

namespace Gdbots\Bundle\CryptoBundle\Command;

use Defuse\Crypto\Key;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CreateKeyCommand extends Command
{
    protected static $defaultName = 'crypto:create-key';

    protected function configure()
    {
        $this->setDescription('Creates a new encryption key using "Defuse\Crypto\Key::createNewRandomKey"');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln(Key::createNewRandomKey()->saveToAsciiSafeString());
        return self::SUCCESS;
    }
}
