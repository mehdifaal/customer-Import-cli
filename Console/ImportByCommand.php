<?php

namespace Faal\CustomerImportCli\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Faal\CustomerImportCli\Model\Files;
use Faal\CustomerImportCli\Model\Customers\Import;

class ImportByCommand extends Command
{
    public const NAME = 'name';
    public const PATH = 'path';
    protected $files;
    protected $customersImport;
    public function __construct(
        Files $files,
        Import $customerImport,
        string $filename = null
    )
    {
        parent::__construct($filename);
        $this->files = $files;
        $this->customersImport = $customerImport;
    }
    protected function configure()
    {
        $options=[
            new InputArgument(self::NAME, InputArgument::REQUIRED),
            new InputArgument(self::PATH, InputArgument::REQUIRED),
        ];
        $this->setName('customer:import')->setDefinition($options);
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = $this->files->readFile(
            $input->getArgument(self::PATH),
            $input->getArgument(self::NAME)
        );
        $this->customersImport->import($data);
        $output->writeln('work is done');
        return $this;
    }

}
