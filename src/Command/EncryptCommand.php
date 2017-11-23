<?php
declare(strict_types=1);

namespace Gdbots\Bundle\CryptoBundle\Command;

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

final class EncryptCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('crypto:encrypt')
            ->setHelp('Encrypts the provided value and returns the string.')
            ->addOption('key', null, InputOption::VALUE_REQUIRED, 'Encryption key, if not supplied the "crypto_key" service will be used.')
            ->addArgument('value', InputArgument::REQUIRED, 'The value to encrypt.');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $key = $input->getOption('key');

        if (!empty($key)) {
            $key = Key::loadFromAsciiSafeString($key);
        } else {
            $key = $this->getContainer()->get('crypto_key');
        }

        $output->writeln(Crypto::encrypt($input->getArgument('value'), $key));
    }
}
