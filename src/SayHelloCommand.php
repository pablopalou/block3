<?php namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class SayHelloCommand extends Command {

    public function configure(){
        $this->setName('sayHelloTo')
            ->setDescription('Offer a greeting')
            ->addArgument('name', InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output){
        $message = 'Hello, ' . $input->getArgument('name');
        $output->writeln("<info>{$message}</info>");
        return 0;
    }

}