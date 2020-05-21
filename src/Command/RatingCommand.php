<?php

namespace App\Command;

use App\Domain\Manager\RatingManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *  Класс команды для получения рэйтинга.
 */
class RatingCommand extends Command
{
    /** @var string Адрес команды. */
    protected static $defaultName = 'app:rating';

    /** Менеджер рэйтинга. */
    private RatingManager $ratingManager;

    /**
     * Конструктор.
     *
     * @param RatingManager $ratingManager
     */
    public function __construct(RatingManager $ratingManager)
    {
        $this->ratingManager = $ratingManager;

        parent::__construct();
    }

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this->addArgument('address', InputArgument::REQUIRED, 'Endpoint address.');
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $address = $input->getArgument('address');

        $res = $this->ratingManager->getRatingByAddress($address);

        $output->writeln([
            'Rating',
            '============',
            '',
        ]);

        $output->writeln(\json_encode($res->toArray()));

        return 0;
    }
}
