<?php

namespace App\Command;

use App\Bot\Bot;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
  name: 'git:bot',
  description: 'Bot for contributions',
)]
class GitBotCommand extends Command
{
  public function __construct(
    private Bot $gitBot
  ) {
    parent::__construct();
  }

  protected function configure(): void
  {
    $this;
  }

  protected function execute(InputInterface $input, OutputInterface $output): int
  {
    $io = new SymfonyStyle($input, $output);

    $io->success($this->gitBot->play());

    return Command::SUCCESS;
  }
}
