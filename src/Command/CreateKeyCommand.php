<?php
declare(strict_types=1);

namespace Gdbots\Bundle\CryptoBundle\Command;

use Defuse\Crypto\Key;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CreateKeyCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('crypto:create-key')
            ->setHelp('Creates a new encryption key using "Defuse\Crypto\Key::createNewRandomKey"');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(Key::createNewRandomKey()->saveToAsciiSafeString());
    }
}
