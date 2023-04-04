<?php

declare(strict_types=1);

namespace App\Command\Decorator;

use App\DesignPatterns\Decorator\UserRequestService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('app:user:request')]
class UserRequestCommand extends Command
{
    public function __construct(private readonly UserRequestService $service)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp('This command helps to create/update user details')
            ->setDescription('This command helps to create/update user details')
            ->addOption('userDetails', 'ud', InputOption::VALUE_REQUIRED)
            ->addOption('action', 'a', InputOption::VALUE_REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$input->getOption('userDetails')) {
            $output->writeln("Enter a comma separated list of user details e.g name=jenny,email=jen@test.com");
            return Command::FAILURE;
        }

        if (!$input->getOption('action')) {
            $output->writeln("Enter the user request action");
            return Command::FAILURE;
        }

        $userDetails = explode(',', trim($input->getOption('userDetails')));
        $userRequestAction = $input->getOption('action');
        $requestDetails = [];
        foreach ($userDetails as $detail) {
            list($key, $value) = explode('=', $detail);
            $requestDetails[$key] = $value;
        }

        $query = $this->service->request($requestDetails, $userRequestAction);
        $output->writeln("\n$query\n");
        return Command::SUCCESS;
    }
}
