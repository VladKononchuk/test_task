<?php

declare(strict_types=1);

namespace AppBundle\Command;

use AppBundle\Service\ImportAutomobilesDataService;
use AppBundle\Service\ImportOwnersDataService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class DataImportCommand extends Command
{
    protected static $defaultName = 'app:import-data';
    private $importAutomobilesDataService;
    private $importOwnersDataService;

    public function __construct(
        ImportAutomobilesDataService $importAutomobilesDataService,
        ImportOwnersDataService $importOwnersDataService
    ) {
        $this->importAutomobilesDataService = $importAutomobilesDataService;
        $this->importOwnersDataService = $importOwnersDataService;
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $invalidOwnerStrings
            = $this->importAutomobilesDataService->importAutomobileData();
        $invalidAutomobileStrings
            = $this->importOwnersDataService->importOwnerData();

        $io->comment(
            sprintf(
                'Invalid strings: %s %s',
                $invalidOwnerStrings,
                $invalidAutomobileStrings
            )
        );

        $io->success('success');
    }
}
