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
    /**
     * @var string
     */
    protected static $defaultName = 'app:import-data';

    /**
     * @var ImportAutomobilesDataService
     */
    private $importAutomobilesDataService;

    /**
     * @var ImportOwnersDataService
     */
    private $importOwnersDataService;

    public function __construct(
        ImportAutomobilesDataService $importAutomobilesDataService,
        ImportOwnersDataService $importOwnersDataService
    ) {
        $this->importAutomobilesDataService = $importAutomobilesDataService;
        $this->importOwnersDataService = $importOwnersDataService;
        parent::__construct();
    }

    public function execute(
        InputInterface $input,
        OutputInterface $output
    ): void {
        $contentOfOwner = file_get_contents(
            $_ENV['OWNER_PATH']
        );
        $owners = json_decode($contentOfOwner, true);

        $contentOfAutomobile = file_get_contents(
            $_ENV['AUTOMOBILE_PATH']
        );
        $automobiles = json_decode($contentOfAutomobile, true);

        $invalidAutomobileStrings
            = $this->importAutomobilesDataService->importAutomobileData(
            $automobiles,
        );
        $invalidOwnerStrings
            = $this->importOwnersDataService->importOwnerData(
            $owners,
            $automobiles,
        );

        $io = new SymfonyStyle($input, $output);

        $io->comment(
            sprintf(
                'Invalid strings: %s %s',
                $invalidOwnerStrings,
                $invalidAutomobileStrings,
            )
        );

        $io->success('success');
    }
}
