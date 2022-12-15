<?php
declare(strict_types=1);

namespace Gdbots\Bundle\CryptoBundle\Command;

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'crypto:decrypt',
    description: 'Decrypts the provided value and returns the string.',
)]
final class DecryptCommand extends Command
{
    public function __construct(private Key $key)
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
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
