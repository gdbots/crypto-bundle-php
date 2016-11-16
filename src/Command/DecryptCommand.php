<?php

namespace Gdbots\Bundle\CryptoBundle\Command;

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DecryptCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('crypto:decrypt')
            ->setHelp('Decrypts the provided value and returns the string.')
            ->addOption('key', null, InputOption::VALUE_REQUIRED, 'Encryption key, if not supplied the "crypto_key" service will be used.')
            ->addArgument('value', InputArgument::REQUIRED, 'The value to decrypt.')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!empty($key)) {
            $key = Key::loadFromAsciiSafeString($key);
        } else {
            $key = $this->getContainer()->get('crypto_key');
        }

        $output->writeln(Crypto::decrypt($input->getArgument('value'), $key));
    }
}
