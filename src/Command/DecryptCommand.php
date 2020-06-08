<?php
declare(strict_types=1);

namespace Gdbots\Bundle\CryptoBundle\Command;

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

final class DecryptCommand extends Command
{
    protected static $defaultName = 'crypto:decrypt';

    private Key $key;

    public function __construct(Key $key)
    {
        $this->key = $key;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Decrypts the provided value and returns the string.')
            ->addOption('key', null, InputOption::VALUE_REQUIRED, 'Encryption key, if not supplied the "crypto_key" service will be used.')
            ->addArgument('value', InputArgument::REQUIRED, 'The value to decrypt.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $key = $input->getOption('key');

        if (!empty($key)) {
            $key = Key::loadFromAsciiSafeString($key);
        } else {
            $key = $this->key;
        }

        $output->writeln(Crypto::decrypt($input->getArgument('value'), $key));
        return self::SUCCESS;
    }
}
