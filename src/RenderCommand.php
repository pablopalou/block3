<?php namespace Acme;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class RenderCommand extends Command {

    public function configure(){
        $this->setName('show')
            ->setDescription('Render some tabular data.')
            ->addArgument('name', InputArgument::REQUIRED)
            ->addOption('fullPlot', null, InputOPTION::VALUE_NONE);
    }

    public function execute(InputInterface $input, OutputInterface $output){
        $table = new Table($output);
        if ($input->getOption('fullPlot')){
            $client = new Client(['base_uri' => 'http://www.omdbapi.com/?apikey=17291a89&t=' .  $input->getArgument('name') . '&plot=full']);
        } else {
            $client = new Client(['base_uri' => 'http://www.omdbapi.com/?apikey=17291a89&t=' .  $input->getArgument('name')]);
        }
        $response = $client->request('GET');
        $body = $response->getBody();
        
        
        $response = json_decode($body, true);
        #print_r($response);

        $message = $input->getArgument('name') . " - " . $response["Year"]; 
        $output->writeln("<info>{$message}</info>");

        $rows = [];
        foreach ($response as $key => $value){
            if (strcmp($key, "Ratings") == 0){
                continue;
            } else {
                $rows[] = [$key, $value];
            }
            
        }
        
        $table->setRows($rows);
        
        $table->render();
        return 0;
    }

}